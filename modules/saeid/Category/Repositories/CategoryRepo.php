<?php

namespace saeid\Category\Repositories;
use saeid\Category\Model\Category;

class CategoryRepo{

    public function all()
    {
        return Category::all();
    }
    public function findById($id)
    {
        return Category::find($id);
    }

    public function store($value)
    {
        return  Category::create([
            'title'=>$value->title,
            'slug'=>$value->slug,
            'parent_id'=>$value->parent_id,
        ]);
    }
    public function allExpectId($id)
    {
        return $this->all()->filter(function ($item) use($id){
           return $item->id != $id;
        });
    }
  /*  public function getCategory($category)
    {

        return Category::where('id' , '!=' ,$category->id)->get();
    }*/
    public function update($id,$value)
    {
        return Category::where('id',$id)
            ->update([
            'title'=>$value->title,
            'slug'=>$value->slug,
            'parent_id'=>$value->parent_id,
            ]);
    }
    public function deleteCat($id,$value)
    {
        return Category::query()->where('id',$id)->delete();
    }
    public function tree()
    {
        return Category::query()->where('parent_id',null)
            ->with('subParentCategory')->get();
    }
}
