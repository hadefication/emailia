<?php

namespace Hadefication\Emailia\Http\Livewire;

use Livewire\Component;
use Hadefication\Emailia\Models\EmailLog;

class Index extends Component
{
    public $messageId;

    protected $listeners = [
        'refresh' => '$refresh',
        'close'
    ];

    protected $queryString = [
        'messageId'
    ];

    public function mount()
    {
        $this->messageId = request()->get('messageId');
    }

    public function open($messageId)
    {
        $this->emitTo('support.emailia.message', 'open', $this->messageId = $messageId);
    }

    public function close()
    {
        $this->reset();
    }

    public function deleteAll()
    {
        EmailLog::truncate();
        $this->emitTo('support.emailia.message', 'close');
    }

    public function markAllAsRead()
    {
        EmailLog::whereRead(false)
            ->update(['read' => true]);
    }

    public function getEmailsProperty()
    {
        return EmailLog::query()
                        ->latest()
                        ->get();
    }

    public function render()
    {
        return view('emailia::index')
                    ->layout('emailia::layout');
    }
}
