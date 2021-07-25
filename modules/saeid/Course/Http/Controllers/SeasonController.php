<?php

namespace saeid\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use saeid\Commen\Responses\AjaxResponse;
use saeid\Course\Http\Requests\SeasonRequest;
use saeid\Course\Model\Season;
use saeid\Course\Repository\CourseRepo;
use saeid\Course\Repository\SeasonRepo;

class SeasonController extends Controller
{

    public $seasonRepo;
    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->seasonRepo=$seasonRepo;
    }

    public function store($courseId,SeasonRequest $request , CourseRepo $courseRepo)
    {
        $this->authorize('createSeason',$courseRepo->findById($courseId));
        $this->seasonRepo->store($courseId,$request);
        alert()->success('عملیات موفق','عملیات با موفقیت انجام شد');
        return back();
    }
    public function edit($id)
    {

        $season=Season::findOrfail($id);

        $this->authorize('edit',$season);
        return view('Courses::season.edit',compact('season'));
    }
    public function update($id,SeasonRequest $request)
    {
        $season=$this->seasonRepo->findById($id);
        $this->authorize('edit',$season);

        $this->seasonRepo->update($id,$request);
        alert()->success('عملیات موفق','عملیات با موفقیت انجام شد');
        return back();
    }
    public function destroy($id)
    {
        $season=$this->seasonRepo->findById($id);
        $this->authorize('edit',$season);
        $season->delete();
        return back();

    }
    public function accept($id)
    {
        $season=$this->seasonRepo->findById($id);
        $this->authorize('changeConfirmationStatus',$season);
        $this->seasonRepo->UpdateConfirmationStatus($id,Season::CONFIRMATION_STATUS_ACCEPTED);
    }
    public function reject($id)
    {
        $season=$this->seasonRepo->findById($id);
        $this->authorize('changeConfirmationStatus',$season);
        $this->seasonRepo->UpdateConfirmationStatus($id,Season::CONFIRMATION_STATUS_REJECTED);
    }
    public function locked($id)
    {
        $season=$this->seasonRepo->findById($id);
        $this->authorize('changeConfirmationStatus',$season);
        $this->seasonRepo->UpdateStatus($id,Season::STATUS_LOCKED);
    }
    public function opened($id)
    {
        $season=$this->seasonRepo->findById($id);
        $this->authorize('changeConfirmationStatus',$season);
        $this->seasonRepo->UpdateStatus($id,Season::STATUS_OPENED);
    }
}
