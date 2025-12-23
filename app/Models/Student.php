<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Student extends Model
{
     use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'admission_date',
        'address',
        'additional_notes',
        'type',
        'created_by',
        'updated_by',
        'status',
    ];

          
    public static function getRules(): array
{
    return [
        'name'             => 'required|string|max:255',
        'email'            => 'nullable|email|max:255',
        'admission_date'   => 'nullable|date',
        'address'          => 'nullable|string|max:500',
        'additional_notes' => 'nullable|string',
        'type'             => 'nullable|in:new,old',
        'created_by'       => 'nullable|integer|exists:users,id',
        'updated_by'       => 'nullable|integer|exists:users,id',
        'status'           => 'required|boolean',
    ];
}


    private $panel = 'Student';

    public function index() :Collection
    {
        return self::get();
    }

    public function storeData($validated_Data) :bool
    {
        try {
            self::create($validated_Data);
            return true;
        } catch (\Exception $e) {
            session()->flash('failed', 'Something exception occured' . $e->getMessage());
            Log::info('Exception in ' . $this->panel . ' store' . $e->getMessage());
            return false;
        } catch (\Error $er) {
            session()->flash('failed', 'Something error occured' . $er->getMessage());
            Log::info('Error in ' . $this->panel . ' store' . $er->getMessage());
            return false;
        }
    }

    public function edit($id) : self|bool
    {
        try {
            $edit = self::findorfail($id);
            return $edit;
        }
        catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }
         catch (\Exception $e) {
            session()->flash('failed', 'Something exception occured' . $e->getMessage());
            Log::info('Exception in ' . $this->panel . ' edit' . $e->getMessage());
            return false;
        } catch (\Error $er) {
            session()->flash('failed', 'Something error occured' . $er->getMessage());
            Log::info('Error in ' . $this->panel . ' edit' . $er->getMessage());
            return false;
        }
    }
    public function updateData($id, $validated_Data) : bool
    {
        try {
            $update = self::findorfail($id);
            $update->update($validated_Data);
            return true;
        }
        catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }
         catch (\Exception $e) {
            session()->flash('failed', 'Something exception occured' . $e->getMessage());
            Log::info('Exception in ' . $this->panel . ' update' . $e->getMessage());
            return false;
        } catch (\Error $er) {
            session()->flash('failed', 'Something error occured' . $er->getMessage());
            Log::info('Error in ' . $this->panel . ' update' . $er->getMessage());
            return false;
        }
    }

    public function deleteData($id) : bool
    {
        try {
            $update = self::findorfail($id);
            $update->delete();
            return true;
        } 
        catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }
        catch (\Exception $e) {
            session()->flash('failed', 'Something exception occured' . $e->getMessage());
            Log::info('Exception in ' . $this->panel . ' delete' . $e->getMessage());
            return false;
        } catch (\Error $er) {
            session()->flash('failed', 'Something error occured' . $er->getMessage());
            Log::info('Error in ' . $this->panel . ' delete' . $er->getMessage());
            return false;
        }
    }

    public function trashData() : Collection|bool
    {
        try {

            $trash = self::onlyTrashed()->latest()->get();
            return $trash;
        } catch (\Exception $e) {
            session()->flash('failed', 'Something exception occured' . $e->getMessage());
            Log::info('Exception in ' . $this->panel . ' trash' . $e->getMessage());
            return false;
        } catch (\Error $er) {
            session()->flash('failed', 'Something error occured' . $er->getMessage());
            Log::info('Error in ' . $this->panel . ' trash' . $er->getMessage());
            return false;
        }
    }
    public function restoreData($id) :bool
    {
        try {
            $data = self::onlyTrashed()->findOrFail($id);
            $data->restore();
            return true;
        }catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }
         catch (\Exception $e) {
            Log::error('Restore exception in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }
    }

    public function forceDeleteData($id) :bool
    {
        try {
            $data = self::onlyTrashed()->findOrFail($id);
            $data->forceDelete(); // permanently deletes
            return true;
        } 
        catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }catch (\Exception $e) {
            Log::error('Force delete exception in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }
    }
}
