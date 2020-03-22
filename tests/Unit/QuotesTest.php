<?php

namespace Tests\Unit;

use App\Mail\CompanyQoute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class QuotesTest extends TestCase
{

    /**
     *
     * @test
     *
     * @return void
     */

    public function sendEmail()
    {
        $data = [
            'email' => 'hossamhassan14895@gmail.com',
            'start_date' => '2017-02-11',
            'end_date' => '2017-08-11',
            'company_name' => 'Google',
        ];

        Mail::fake();

        Mail::assertNothingSent();

        $this->post(route('quotes.send-email'), $data)
            ->assertStatus(200)
            ->assertJson(["data" => "done"]);

        Mail::assertSent(CompanyQoute::class, function ($mail) use ($data) {
            return $mail->hasTo($data['email']);
        });
    }
}
