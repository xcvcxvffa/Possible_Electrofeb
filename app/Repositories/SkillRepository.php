<?php

namespace App\Repositories;

use App\Models\Skill;

class SkillRepository
{
    public function getAll()
    {
        return Skill::orderBy('name')->get();
    }

    public function getAllActive()
    {
        return Skill::active()->get();
    }
}
