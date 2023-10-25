<?php

namespace App\Traits;

trait SweetAlert
{
    public function flashSuccess($title, $text)
    {
        session()->flash('swal', [
            'icon' => 'success',
            'title' => $title,
            'text' => $text,
            'timer' => 5000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function flashError($title, $text)
    {
        session()->flash('swal', [
            'icon' => 'error',
            'title' => $title,
            'text' => $text,
            'timer' => 5000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function success($title, $text)
    {
        $this->dispatchBrowserEvent('swal', [
            'icon' => 'success',
            'title' => $title,
            'text' => $text,
            'timer' => 5000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function error($title, $text)
    {
        $this->dispatchBrowserEvent('swal', [
            'icon' => 'error',
            'title' => $title,
            'text' => $text,
            'timer' => 5000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function warning($title, $text)
    {
        $this->dispatchBrowserEvent('swal', [
            'icon' => 'warning',
            'title' => $title,
            'text' => $text,
            'timer' => 5000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function confirm($title = 'Are you sure?', $text = '', $params = ['onConfirm' => '', 'params' => []])
    {
        $this->dispatchBrowserEvent('swal_warning', [
            'icon' => 'warning',
            'title' => $title,
            'text' => $text,
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'OK',
            'onConfirm' => isset($params['onConfirm']) ? $params['onConfirm'] : null,
            'params' => isset($params['params']) ? $params['params'] : null,
        ]);
    }
}
