<?php

namespace Hadefication\Emailia\Http\Livewire;

use Livewire\Component;
use Hadefication\Emailia\Models\EmailLog;

class Message extends Component
{
    public $messageId;
    public $tab = 'html';

    protected $listeners = [
        'open',
        'close'
    ];

    public function mount($id = null)
    {
        $this->open($id);
    }

    public function open($id)
    {
        if ($email = $this->getEmail($id)) {
            tap($email, function ($email) {
                $this->fill(['messageId' => $email->id]);
    
                $email->update([
                    'read' => true
                ]);
    
                $this->emitUp('refresh');
            });
        }
    }

    public function close()
    {
        $this->reset();
        $this->emitUp('close');
    }

    public function remove()
    {
        if ($this->messageId) {
            $this->getEmail($this->messageId)
                ->delete();

            $this->close();
        }
    }

    public function getEmailProperty()
    {
        return $this->getEmail($this->messageId);
    }

    public function getTabsProperty()
    {
        return [
            'html' => 'HTML',
            'html_source' => 'HTML Source',
            'text' => 'Text',
            'raw' => 'Raw',
        ];
    }

    private function getEmail($id)
    {
        return EmailLog::find($id);
    }

    public function render()
    {
        return view('emailia::message');
    }
}
