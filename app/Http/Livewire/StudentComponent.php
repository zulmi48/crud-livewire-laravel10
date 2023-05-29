<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentComponent extends Component
{
    public $id_data, $student_id, $name, $email, $phone;

    public function updated($fields) //Input Fields Validation
    {
        $this->validateOnly($fields, [
            'student_id' => 'required|unique:students,student_id, ' . $this->id_data . ' ',
            'name' => 'required|min:3|alpha',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
        ]);
    }

    public function resetInput()
    {
        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->id_data = '';
    }

    public function create()
    {
        $this->dispatchBrowserEvent('open-create-modal');
        $this->resetInput();
    }

    public function store()
    {
        // Form Validation
        $this->validate([
            'student_id' => 'required|unique:students',
            'name' => 'required|min:3|alpha',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
        ]);

        Student::create([
            'student_id' => $this->student_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'New Student has been added successfully!');

        $this->dispatchBrowserEvent('close-modal');

        $this->resetInput();
    }

    public function show($id)
    {
        $student = Student::find($id);
        $this->student_id = $student->student_id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;

        $this->dispatchBrowserEvent('open-show-modal');
    }

    public function edit($id)
    {
        $student = Student::find($id);

        $this->id_data = $student->id;
        $this->student_id = $student->student_id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;

        $this->dispatchBrowserEvent('open-edit-modal');
    }

    public function update()
    {
        // Form Validation
        $this->validate([
            'student_id' => 'required|unique:students,student_id, ' . $this->id_data . ' ',
            'name' => 'required|min:3|alpha',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
        ]);

        Student::where('id', $this->id_data)->update([
            'student_id' => $this->student_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'Edit Student data has been updated successfully!');

        $this->dispatchBrowserEvent('close-modal');

        $this->resetInput();
    }

    public function deleteConirmation($id)
    {
        $this->id_data = $id;
        $student = Student::find($id);
        $this->student_id = $student->student_id;

        $this->dispatchBrowserEvent('open-delete-modal');
    }

    public function destroy()
    {
        $student = Student::where('id', $this->id_data)->first();
        Student::destroy($student->id);

        session()->flash('message', 'Student data has been deleted successfully!');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $students = Student::all();
        return view('livewire.student-component', compact('students'))->layout('livewire.layouts.base');
    }
}
