<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Course extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'image',
        'slug',
        'price',
        'status',
        'created_by',
        'updated_by',
    ];


    public static function getRules($id = null): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            
            'price'       => 'nullable|numeric|min:0',
            'status'      => 'required|boolean',
            'created_by'  => 'nullable|exists:users,id',
            'updated_by'  => 'nullable|exists:users,id',
        ];
    }

    private $panel = 'Course';


    public function slugExist($slug, $id = null): bool
    {

        $isExisted = self::where('slug', $slug)->first();

        if (!$isExisted) {
            return false; // Slug does not exist.
        }

        if ($id) {
            if ($isExisted->id == $id) {
                return false;
            } else {
                return true;
            }
        }

        return true; // Slug exists and ID is not provided.
    }

     public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')
            ->select('id', 'name');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'name');
    }

    public function index(): Collection
    {
        return self::get();
    }

    public function storeData($validated_Data): bool
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

    public function edit($id): self|bool
    {
        try {
            $edit = self::findorfail($id);
            return $edit;
        } catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            session()->flash('failed', 'Something exception occured' . $e->getMessage());
            Log::info('Exception in ' . $this->panel . ' edit' . $e->getMessage());
            return false;
        } catch (\Error $er) {
            session()->flash('failed', 'Something error occured' . $er->getMessage());
            Log::info('Error in ' . $this->panel . ' edit' . $er->getMessage());
            return false;
        }
    }
    public function updateData($id, $validated_Data): bool
    {
        try {
            $update = self::findorfail($id);
            $update->update($validated_Data);
            return true;
        } catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            session()->flash('failed', 'Something exception occured' . $e->getMessage());
            Log::info('Exception in ' . $this->panel . ' update' . $e->getMessage());
            return false;
        } catch (\Error $er) {
            session()->flash('failed', 'Something error occured' . $er->getMessage());
            Log::info('Error in ' . $this->panel . ' update' . $er->getMessage());
            return false;
        }
    }

    public function deleteData($id): bool
    {
        try {
            $update = self::findorfail($id);
            $update->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            session()->flash('failed', 'Something exception occured' . $e->getMessage());
            Log::info('Exception in ' . $this->panel . ' delete' . $e->getMessage());
            return false;
        } catch (\Error $er) {
            session()->flash('failed', 'Something error occured' . $er->getMessage());
            Log::info('Error in ' . $this->panel . ' delete' . $er->getMessage());
            return false;
        }
    }

    public function trashData(): Collection|bool
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
    public function restoreData($id): bool
    {
        try {
            $data = self::onlyTrashed()->findOrFail($id);
            $data->restore();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            Log::error('Restore exception in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }
    }

    public function forceDeleteData($id): bool
    {
        try {
            $data = self::onlyTrashed()->findOrFail($id);
            $data->forceDelete(); // permanently deletes
            return true;
        } catch (ModelNotFoundException $e) {
            Log::warning('Record not found for force delete in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            Log::error('Force delete exception in ' . $this->panel . ': ' . $e->getMessage());
            return false;
        }
    }
}
