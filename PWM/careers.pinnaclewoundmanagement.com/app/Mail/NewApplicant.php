<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewApplicant extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        $app = \Illuminate\Support\Facades\DB::select("SELECT CONCAT(tja.First_Name, ' ', tja.Last_Name) AS FullName,
                                    tjp.Title, City, tjp.State, tja.First_Name, tja.Last_Name, tja.Email, tja.Phone_Number,tja.Resume, tja.FileName, tja.Extension
                                    FROM tbl_Job_Applicants tja
                                join tbl_Job_Post tjp ON tja.Job_ID = tjp.id WHERE tja.id = " . $this->applicant);
        $this->subject('Applicant: ' . $app[0]->FullName)
                    ->view('emails.newapplicant')
                    ->with(['applicant' => $app]);
        //if ($this->applicant->cv) {
            //$cvFile = Storage::path($this->applicant->cv);

            return $this->attachData(base64_decode($app[0]->Resume, true), $app[0]->FileName);
        //}
        
        return $this;
    }
}
