<?php

namespace Kv\MyCrm\Http\Livewire\Components;

use Livewire\Component;
use Kv\MyCrm\Models\Meeting;
use Kv\MyCrm\Models\Person;
use Kv\MyCrm\Services\SettingService;
use Kv\MyCrm\Traits\HasGlobalSettings;
use Kv\MyCrm\Traits\NotifyToast;

class LiveMeeting extends Component
{
    use NotifyToast;
    use HasGlobalSettings;

    private $settingService;
    public $meeting;
    public $editMode = false;
    public $name;
    public $description;
    public $start_at;
    public $finish_at;
    public $guests = [];
    public $location;
    public $showRelated = false;
    public $view;

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public function boot(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function mount(Meeting $meeting, $view = 'meeting')
    {
        $this->meeting = $meeting;
        $this->name = $meeting->name;
        $this->description = $meeting->description;
        $this->start_at = ($meeting->start_at) ? $meeting->start_at->format($this->dateFormat().' H:i') : null;
        $this->finish_at = ($meeting->finish_at) ? $meeting->finish_at->format($this->dateFormat().' H:i') : null;
        $this->guests = $meeting->contacts()->pluck('entityable_id')->toArray();
        $this->location = $meeting->location;

        if($this->settingService->get('show_related_activity')->value == 1) {
            $this->showRelated = true;
        }

        $this->view = $view;
    }

    /**
     * Returns validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => "required",
            'description' => "nullable",
            'start_at' => 'required',
            'finish_at' => 'required',
            'guests' => 'nullable',
            'location' => "nullable",
        ];
    }

    public function update()
    {
        $this->validate();
        $this->meeting->update([
            'name' => $this->name,
            'description' => $this->description,
            'start_at' => $this->start_at,
            'finish_at' => $this->finish_at,
            'location' => $this->location,
        ]);

        foreach ($this->guests as $personId) {
            if ($person = Person::find($personId)) {
                $this->meeting->contacts()->firstOrCreate([
                    'entityable_type' => $person->getMorphClass(),
                    'entityable_id' => $person->id,
                ]);

                foreach ($this->meeting->contacts as $contact) {
                    if (! in_array($contact->entityable_id, $this->guests)) {
                        $contact->delete();
                    }
                }
            }
        }

        $this->toggleEditMode();
        $this->emit('refreshComponent');
        $this->notify(
            ucfirst(trans('my-crm::lang.meeting_updated'))
        );
    }

    public function delete()
    {
        $this->meeting->delete();

        $this->emit('meetingDeleted');
        $this->notify(
            ucfirst(trans('my-crm::lang.meeting_deleted'))
        );
    }

    public function toggleEditMode()
    {
        $this->editMode = ! $this->editMode;

        $this->dispatchBrowserEvent('meetingEditModeToggled');
    }

    public function render()
    {
        return view('my-crm::livewire.components.'.$this->view);
    }
}
