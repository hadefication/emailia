<?php

use Hadefication\Emailia\Http\Livewire\Index;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Hadefication\Emailia\Models\EmailLog;

Route::get('emailia', Index::class)->name('emailia');
Route::get('emailia/m/{id}', function ($id) {
    $email = EmailLog::find($id);
    return $email->details['content_html'];
})->name('emailia.message.render');

Route::get('emailia/test', function () {
    class TestMail extends Mailable {
        public function build()
        {
            return $this->markdown('emailia::test')
                        ->replyTo('boo@gmail.com', 'Boo Guy')
                        ->bcc('test@gmail.com', 'Cool Guy')
                        ->bcc('awesome@gmail.com', 'Awesome Guy')
                        ->attach(storage_path('logs/emailia.log'));
        }
    }


    Mail::to('glen@eetechmedia.com')->send(new TestMail);
});