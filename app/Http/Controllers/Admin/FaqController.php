<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index() {
        $faqs = Faq::latest()->paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }
    public function add() {
        return view('admin.faq.add');
    }
    public function save(Request $request) {
        $data = [
            'question' => $request->question,
            'question_ar' => $request->question_ar,
            'question_en' => $request->question_en,
            'answer' => $request->answer,
            'answer_ar' => $request->answer_ar,
            'answer_en' => $request->answer_en,
        ];
        $faq = Faq::create($data);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function edit($id) {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }
    public function update(Request $request) {
        $faq = Faq::findOrFail($request->faq_id);
        $data = [
            'question' => $request->question,
            'question_ar' => $request->question_ar,
            'question_en' => $request->question_en,
            'answer' => $request->answer,
            'answer_ar' => $request->answer_ar,
            'answer_en' => $request->answer_en,
        ];
        $faq->update($data);
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
    public function delete(Request $request) {
        $faq = Faq::findOrFail($request->faq_id);
        $faq->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }

}
