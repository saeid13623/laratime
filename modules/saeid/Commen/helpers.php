<?php



function newfeedback($title = 'عملیات موفقیت آمیز', $body = 'عملیات با موفقیت انجام شد', $type = 'success'){
    if(session()->has('feedbacks')){
        $session=session()->get('feedbacks');
    }else{
        $session=[];
    }

    $session[]=['title'=>$title,'body'=>$body,'type'=>$type];
    session()->flash('feedbacks',$session);
}
