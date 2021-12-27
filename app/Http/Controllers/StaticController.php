<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Chapter;
use App\Models\SubChapter;
use App\Models\ProductGroup;
use App\Models\Product;
use App\Models\Action;
use Illuminate\Http\Request;
//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\App;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Settings;

class StaticController extends Controller
{
    use HelperTrait;

    protected $data = [];
//    protected $breadcrumbs = [];


    public function index($token=null)
    {
//        $chapters = Chapter::where('active',1)->whereIn('id',[1,2])->get();
//        $this->data['chapters'] = [];
//        foreach ($chapters as $chapter) {
//            $this->data['chapters'][$chapter->id] = $chapter;
//        }
//        $this->getItems(new ProductGroup(), 'catalogue');
//        $this->getItems(new Action(), 'actions');
        return $this->showView('home', $token);
    }

//    public function chapter(Request $request, $slug, $subSlug=null)
//    {
//        if ($subSlug) $this->getItem($request, new SubChapter(), $subSlug);
//        else $this->getItem($request, new Chapter(), $slug);
//        return $this->showView('chapter');
//    }
//
//    public function catalogue(Request $request, $slug)
//    {
//        $this->getItem($request, new ProductGroup(), $slug);
//        if ($request->has('id')) $this->getItem($request, new Product(), null, 'product');
//        return $this->showView('products');
//    }
//    
//    public function termOfUse()
//    {
//        return $this->showView('termOfUse');
//    }
//
//    protected function showView($view,$token=null)
//    {
//        var_dump(1111111);
//        die;
//        
//        $this->data['seo'] = Settings::getSeoTags();
//        $chapters = Chapter::where('active',1)->get(['id','slug','name']);
//        $mainMenu = [];
//        $menuCnt = 0;
//
//        foreach ($chapters as $chapter) {
//            if ($chapter->id == 2 || ($chapter->id > 2 && !$menuCnt)) {
//                $catalogue = ProductGroup::where('active',1)->get(['slug','name']);
//                $catalogueSubMenu = [];
//                foreach ($catalogue as $group) {
//                    $catalogueSubMenu[] = ['name' => $group->name, 'href' => $group->slug];
//                }
//                $mainMenu[] = ['name' => trans('menu.catalogue'), 'data_scroll' => 'catalogue', 'dropdown' => $catalogueSubMenu];
//                $mainMenu[] = ['name' => trans('menu.actions'), 'data_scroll' => 'actions'];
//            }
//
//            $chapterSubMenu = [];
//            if (count($chapter->subChaptersActive)) {
//                foreach ($chapter->subChaptersActive as $subChapter) {
//                    $chapterSubMenu[] = ['name' => $subChapter->name, 'href' => $subChapter->slug, 'prefix' => 'chapter'];
//                }
//            }
//
//            $mainMenu[] = [
//                'name' => $chapter->name, ($chapter->id >= 3 ? 'href' : 'data_scroll') => ($chapter->id >= 3 ? 'chapter/'.$chapter->slug : $chapter->slug),
//                'dropdown' => $chapterSubMenu
//            ];
//            $menuCnt++;
//        }
//
//        return view($view, [
//            'mainMenu' => $mainMenu,
//            'data' => $this->data,
//            'metas' => $this->metas,
//            'slides' => $this->getItems(new Slide()),
//            'token' => $token
//        ]);
//    }
}
