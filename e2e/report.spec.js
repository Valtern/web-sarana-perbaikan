import { test, expect } from '@playwright/test';

test('Full user flow: Login, Create Report, Logout', async ({ page }) => {

  // 1. Open and go to Login page
  await page.goto('http://127.0.0.1:8000/');
  await page.setViewportSize({ width: 1613, height: 1020 });
  await page.getByRole('link', { name: 'Log in' }).click();

  // 2. Fill in login form and click
  await page.getByLabel('Email address').fill('student@example.com');
  await page.getByLabel('Password', { exact: true }).fill('password');

  // Wait for navigation after clicking login
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'networkidle' }),
    page.getByRole('button', { name: 'Log in' }).click()
  ]);

  // 3. Wait for successful login by waiting for the Report link to appear
  // Wait for the page to fully load first
  await page.waitForLoadState('domcontentloaded');
  await page.waitForTimeout(1000); // Extra wait for WebKit

  const reportLink = page.getByRole('link', { name: 'Report', exact: true });
  await expect(reportLink).toBeVisible({ timeout: 15000 });

  // Click the "Report" link
  await reportLink.click();

  // 4. Verify we are on the Report Form
  await expect(page.getByRole('heading', { name: 'Fill in the Report Form' })).toBeVisible();

  // 5. Fill out the report form
  await page.locator('#facility_name').fill('reparation');
  await page.locator('#location').fill('as');
  await page.locator('#category').selectOption({ label: 'Miscellaneous' });
  await page.locator('#description').fill('idk');

  // 6. Submit the form
  await page.locator('.inline-flex:nth-child(1) > .text-sm').click(); // Checkbox
  await page.locator('.text-white').click(); // Submit button

  // 7. Verify the success message (Toaster)
  await expect(page.getByText('Laporan berhasil dikirim!')).toBeVisible();

  // 8. Wait for page to be stable before logout
  await page.waitForLoadState('networkidle');
  await page.waitForTimeout(1500); // Wait for any animations/toasts

  // 9. Log out - Click the first profile button and wait for its specific menu
  const profileButton = page.locator('button[data-flux-profile]').first();
  await profileButton.click();

  // Wait for dropdown to open and logout button to be visible
  // Use .first() to handle both desktop and mobile menus
  await page.waitForTimeout(500); // Wait for dropdown animation

  // Click the logout button - using the text content which is most reliable
  // Get the first visible logout button (from the desktop menu)
  const logoutButton = page.getByRole('menuitem', { name: 'Log Out' }).first();
  await logoutButton.click();

  // 10. Final verification - back to login page
  await expect(page.getByRole('link', { name: 'Log in' })).toBeVisible({ timeout: 10000 });
});
