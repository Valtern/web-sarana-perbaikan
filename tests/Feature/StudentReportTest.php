<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\ReportService;
use App\Livewire\Student\SubmitReport;
use Livewire\Livewire;
use Mockery\MockInterface;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase; // <--- IMPORT THIS

class StudentReportTest extends TestCase
{
    use RefreshDatabase; // <--- ADD THIS LINE

    public function test_student_can_submit_report_mocking_service()
    {
        // 1. Login
        /** @var \App\Models\User $student */
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($student);

        // 2. Setup the Test Double (Mock)
        $this->mock(ReportService::class, function (MockInterface $mock) {
            $mock->shouldReceive('createReport')
                ->once()
                ->withArgs(function ($data) {
                    return $data['facility_name'] === 'reparation'
                        && $data['location'] === 'as'
                        && $data['category'] === 'Miscellaneous'
                        && $data['description'] === 'idk';
                })
                ->andReturn(true);
        });

        Storage::fake('public');
        $file = UploadedFile::fake()->image('proof.jpg');

        // 3. Execute the Flow
        Livewire::test(SubmitReport::class)
            ->set('facility_name', 'reparation')
            ->set('location', 'as')
            ->set('category', 'Miscellaneous')
            ->set('description', 'idk')
            ->set('picture_proof', $file)
            ->call('submit')
            // 4. Verification
            ->assertDispatched('report-submitted')
            ->assertHasNoErrors();
    }
}
