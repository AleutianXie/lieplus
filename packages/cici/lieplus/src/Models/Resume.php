<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\EmailAlreadyExists;
use Cici\Lieplus\Exceptions\MobileAlreadyExists;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Resume model instance
 */
class Resume extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('resumes');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $sn            = 'JL0000000001';
        $name          = $attributes['name'];
        $gender        = $attributes['gender'];
        $mobile        = $attributes['mobile'];
        $email         = $attributes['email'];
        $degree        = $attributes['degree'];
        $province      = $attributes['province'];
        $city          = $attributes['city'];
        $county        = $attributes['county'];
        $birthdate     = $attributes['birthdate'];
        $startworkdate = $attributes['startworkdate'];
        $industry      = $attributes['industry'];
        $position      = $attributes['position'];
        $salary        = $attributes['salary'];
        $others        = $attributes['others'];
        $creater       = $attributes['creater'];
        $modifier      = $attributes['modifier'];

        if (static::getResumes()->where('mobile', $mobile)->first()) {
            throw MobileAlreadyExists::create($mobile);
        }
        if (static::getResumes()->where('email', $email)->first()) {
            throw EmailAlreadyExists::create($email);
        }
        static::query()->create(compact(
            'sn',
            'name',
            'gender',
            'mobile',
            'email',
            'degree',
            'province',
            'city',
            'county',
            'birthdate',
            'startworkdate',
            'industry',
            'position',
            'salary',
            'others',
            'creater',
            'modifier'
        ));
        dd('OK');
        // add my library
                // $mylibrary = new MyLibrary();
                // $mylibrary->uid = Auth::id();
                // $mylibrary->rid = $resume->id;
                // $mylibrary->creater = Auth::id();
                // $mylibrary->save();

                // // add job library
                // if (isset($data['jid']) && !empty($data['jid'])) {
                //     $joblibrary          = new JobLibrary();
                //     $joblibrary->uid     = Auth::id();
                //     $joblibrary->rid     = $resume->id;
                //     $joblibrary->jid     = $data['jid'];
                //     $joblibrary->creater = Auth::id();
                //     $joblibrary->save();
                //     // add to station
                //     $station             = new Station();
                //     $station->sn         = Helper::generationSN('GZT');
                //     $station->lid        = $joblibrary->line->id;
                //     $station->rid        = $resume->id;
                //     $station->status     = 1;
                //     $station->creater    = Auth::id();
                //     $station->modifier   = Auth::id();
                //     $station->save();
                // }
    }

    /**
     * Get the current cached resume.
     */
    protected static function getResumes(): Collection
    {
        return app(Resume::class)->get();
    }
}
