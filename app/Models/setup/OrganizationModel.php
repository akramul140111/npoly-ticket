<?php

namespace App\Models\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'org_id';
    protected $flable = ['org_id','ORG_NAME'];
    protected $table = 'sa_organizations';
}
