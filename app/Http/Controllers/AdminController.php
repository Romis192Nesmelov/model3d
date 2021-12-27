<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ProductGroup;
use App\Models\Product;
use App\Models\Order;
use App\Models\Action;
use App\Models\SmsLogin;
use App\Models\Slide;
use App\Models\Chapter;
use App\Models\SubChapter;
use App\Models\Station;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    use HelperTrait;

    protected $data = [];
    protected $breadcrumbs = [];

    // Gets methods
//    public function index()
//    {
//        return redirect('/admin/users');
//    }
//
//    public function users(Request $request, $slug=null)
//    {
//        if (!$request->has('id')) Session::forget('breadcrumbs');
//        return $this->getObjects($request, new User(), $slug, 'user', 'created_at');
//    }
//
//    public function editUser(Request $request)
//    {
//        $validationArr = [
//            'name' => $this->validationCharField,
//            'email' => $this->validationEmail,
//            'phone' => $this->validationPhone,
//            'type' => 'required|integer|in:1,2',
//            'avatar' => $this->validationImage,
//        ];
//        $userBoolFields = ['active','send_mail'];
//        $ignoreFields = ['avatar','password','password_confirmation'];
//
//        $userFields = $this->processingFields($request, $userBoolFields, $ignoreFields);
//        if ($userFields['phone']) $userFields['phone'] = str_replace($this->phoneLeftSymbols,'',$userFields['phone']);
//        if ($request->has('password') && $request->input('password')) $userFields['password'] = bcrypt($request->input('password'));
//
//        // Processing user
//        if ($request->has('id')) {
//            $validationArr['id'] = $this->validationUser;
//            $validationArr['email'] .= ','.$request->input('id');
//
//            if ($request->input('password')) {
//                $validationArr['old_password'] = 'required|min:6|max:50';
//                $validationArr['password'] = $this->validationPassword;
//            } else unset($userFields['password']);
//
//            $this->validate($request, $validationArr);
//            $user = User::find($request->input('id'));
//            $user->update($userFields);
//        } else {
//            $validationArr['password'] = $this->validationPassword;
//            $this->validate($request, $validationArr);
//            $user = User::create($userFields);
//        }
//
//        if ($request->hasFile('avatar')) {
//            $fieldAvatar = $this->processingImage($request, $user, 'avatar', 'user_avatar'.$user->id, 'images/avatars');
//            $user->update($fieldAvatar);
//        }
//
//        return redirect('/admin/users')->with('message',trans('content.save_complete'));
//    }
//
//    public function deleteUser(Request $request)
//    {
//        return $this->deleteSomething($request, new User(), 'avatar');
//    }
//
//    public function deleteSmsLogin(Request $request)
//    {
//        return $this->deleteSomething($request, new SmsLogin());
//    }
//
//    public function productGroups(Request $request, $slug=null)
//    {
//        Session::forget('breadcrumbs');
//        return $this->getObjects($request, new ProductGroup(), $slug, 'name');
//    }
//
//    public function editProductGroup(Request $request)
//    {
//        return $this->editObject(
//            $request,
//            new ProductGroup(),
//            [
//                'name' => $this->validationCharField,
//                'image' => $this->validationImage
//            ],
//            ['active'],
//            [],
//            [],
//            [],
//            'product_groups'
//        );
//    }
//
//    public function deleteProductGroup(Request $request)
//    {
//        return $this->deleteSomething($request, new ProductGroup(), 'image', 'products', 'image');
//    }
//
//    public function products(Request $request, $slug=null)
//    {
//        if ($slug) $this->data['product_groups'] = ProductGroup::all();
//        else Session::forget('breadcrumbs');
//
//        return $this->getObjects($request, new Product(), $slug, 'name');
//    }
//
//    public function editProduct(Request $request)
//    {
//        return $this->editObject(
//            $request,
//            new Product(),
//            [
//                'product_group_id' => 'required|integer|exists:product_groups,id',
//                'name' => $this->validationCharField,
//                'price' => $this->validationIntField,
//                'image' => $this->validationImage
//            ],
//            ['active'],
//            ['parent_id'],
//            [],
//            [],
//            'products'
//        );
//    }
//
//    public function deleteProduct(Request $request)
//    {
//        return $this->deleteSomething($request, new Product(), 'image');
//    }
//
//    public function orders(Request $request, $slug=null)
//    {
//        $this->data['product_groups'] = ProductGroup::all();
//        $this->data['users'] = User::all();
//        if ($request->has('parent_id'))
//            $this->data['product'] = Product::where('id',$request->input('parent_id'))->first();
//        if ($slug != 'add' && !$request->has('id'))
//            Session::forget('breadcrumbs');
//
//        return $this->getObjects($request, new Order(), $slug, 'id', 'created_at');
//    }
//
//    public function editOrder(Request $request)
//    {
//        return $this->editObject(
//            $request,
//            new Order(),
//            [
//                'product_id' => $this->validationProduct,
//                'user_id' => $this->validationUser,
//                'price' => $this->validationIntField,
//                'delivery_type' => $this->validationIntField.'|min:1|max:2',
//                'status' => $this->validationIntField.'|min:1|max:3',
//                'address' => $this->validationCharField,
//            ]
//        );
//    }
//
//    public function getProductPrice(Request $request)
//    {
//        $this->validate($request, ['id' => $this->validationProduct]);
//        return response()->json(['success' => true, 'price' => Product::where('id',$request->input('id'))->pluck('price')->first()]);
//    }
//
//    public function deleteOrder(Request $request)
//    {
//        return $this->deleteSomething($request, new Order());
//    }
//
//    public function actions(Request $request, $slug=null)
//    {
//        if ($slug) $this->data['product_groups'] = ProductGroup::all();
//        else Session::forget('breadcrumbs');
//        
//        return $this->getObjects($request, new Action(), $slug, 'name');
//    }
//
//    public function editAction(Request $request)
//    {
//        return $this->editObject(
//            $request,
//            new Action(),
//            [
//                'product_id' => 'required|integer|exists:products,id',
//                'name' => $this->validationCharField,
//                'description' => $this->validationCharField,
//                'discount' => $this->validationIntField.'|min:10|max:100',
//                'start' => $this->validationDate,
//                'end' => $this->validationDate,
//                'image' => $this->validationImage
//            ],
//            ['active','unlimited'],
//            [],
//            ['start','end'],
//            ['color'],
//            'actions'
//        );
//    }
//
//    public function deleteAction(Request $request)
//    {
//        return $this->deleteSomething($request, new Action(), 'image');
//    }
//
//    public function chapters(Request $request, $slug=null)
//    {
//        if (!$slug) Session::forget('breadcrumbs');
//        return $this->getObjects($request, new Chapter(), $slug, 'name');
//    }
//
//    public function editChapter(Request $request)
//    {
//        return $this->editObject(
//            $request,
//            new Chapter(),
//            ['name' => $this->validationCharField, 'content' => $this->validationTextField],
//            ['active']
//        );
//    }
//    
//    public function subChapters(Request $request, $slug=null)
//    {
//        if ($slug) $this->data['chapters'] = Chapter::all();
//        return $this->getObjects($request, new SubChapter(), $slug, 'name');
//    }
//    
//    public function editSubChapter(Request $request)
//    {
//        return $this->editObject(
//            $request,
//            new SubChapter(),
//            ['name' => $this->validationCharField, 'content' => $this->validationTextField, 'chapter_id' => 'required|integer|exists:chapters,id'],
//            ['active']
//        );
//    }
//    
//    public function deleteSubChapter(Request $request)
//    {
//        return $this->deleteSomething($request, new SubChapter());
//    }
//    
//    public function slides(Request $request, $slug=null)
//    {
//        Session::forget('breadcrumbs');
//        return $this->getObjects($request, new Slide(), $slug, 'head');
//    }
//    
//    public function editSlide(Request $request)
//    {
//        return $this->editObject(
//            $request,
//            new Slide(),
//            ['image' => $this->validationImage, 'head' => $this->validationCharField, 'text' => $this->validationTextField],
//            ['active'],
//            [],
//            [],
//            ['color'],
//            'slides'
//        );
//    }
//    
//    public function deleteSlide(Request $request)
//    {
//        return $this->deleteSomething($request, new Slide(), 'image');
//    }
//    
//    public function stations(Request $request, $slug=null)
//    {
//        if (!$slug) Session::forget('breadcrumbs');
//        return $this->getObjects($request, new Station(), $slug, 'name');
//    }
//
//    public function editStation(Request $request)
//    {
//        return $this->editObject(
//            $request,
//            new Station(),
//            ['name' => $this->validationCharField],
//            ['active']
//        );
//    }
//
//    public function deleteStation(Request $request)
//    {
//        return $this->deleteSomething($request, new Station());
//    }
//
//    public function seo()
//    {
//        Session::forget('breadcrumbs');
//        $this->breadcrumbs = ['seo' => 'SEO'];
//        $this->data['metas'] = $this->metas;
//        $this->data['seo'] = Settings::getSeoTags();
//        return $this->showView('seo');
//    }
//
//    public function editSeo(Request $request)
//    {
//        $this->validate($request, [
//            'title_ru' => $this->validationCharField,
//            'meta_description' => 'max:4000',
//            'meta_keywords' => 'max:4000',
//            'meta_twitter_card' => 'max:255',
//            'meta_twitter_size' => 'max:255',
//            'meta_twitter_creator' => 'max:255',
//            'meta_og_url' => 'max:255',
//            'meta_og_type' => 'max:255',
//            'meta_og_title' => 'max:255',
//            'meta_og_description' => 'max:4000',
//            'meta_og_image' => 'max:255',
//            'meta_robots' => 'max:255',
//            'meta_googlebot' => 'max:255',
//            'meta_google_site_verification' => 'max:255',
//        ]);
//        Settings::saveSeoTags($request);
//        return redirect('/admin/seo')->with('message',trans('content.save_complete'));
//    }
//
//    public function settings()
//    {
//        Session::forget('breadcrumbs');
//        $this->breadcrumbs = ['settings' => trans('admin.settings')];
//        return $this->showView('settings');
//    }
//
//    public function editSettings(Request $request)
//    {
//        $this->validate($request, [
//            'email' => $this->validationNoUniqueEmail,
//            'vk_group' => $this->validationCharField,
//            'phone' => $this->validationPhone
//        ]);
//        Settings::saveSettings($this->processingFields($request));
//        return redirect()->back()->with('message',trans('content.save_complete'));
//    }
//    
//    private function getObjects(Request $request, Model $model, $slug, $headName, $descField=false)
//    {
//        $objectName = substr($model->getTable(),0,-1);
//        $this->breadcrumbs = Session::has('breadcrumbs') ? Session::get('breadcrumbs') : [$objectName.'s' => trans('admin.'.$objectName.'s')];
//        $lastUri = array_key_last($this->breadcrumbs);
//        if (preg_match('/^((actions)\/\w+)|(orders)|((sub-chapters)\/\w+)/',$lastUri)) unset($this->breadcrumbs[$lastUri]);
//
//        if ($request->has('id') || ($slug && $slug != 'add')) {
//            $this->data['item'] = $request->has('id') ? $model->find($request->input('id')) : $model->where('slug',$slug)->first();
//            if (!$this->data['item']) abort(404);
//
//            $breadcrumbNameId = $objectName.'s?id='.$this->data['item']->id;
//            $breadcrumbNameSlug = $objectName.'s/'.$this->data['item']->slug;
//
//            if (isset($this->data['item']->slug)) $this->breadcrumbs[$breadcrumbNameSlug] = $objectName == 'action' ? trans('admin.action',['name' => $this->data['item']->name]) : $this->data['item'][$headName];
//            elseif ($model instanceOf User && isset($this->data['item'])) $this->breadcrumbs[$breadcrumbNameId] = Helper::userCreds($this->data['item']);
//            else $this->breadcrumbs[$breadcrumbNameId] = $headName == 'id' ? trans('admin.'.$objectName.'_number',['number' => $this->data['item']->id]) : $this->data['item'][$headName];
//
//            Session::put('breadcrumbs',$this->breadcrumbs);
//            return $this->showView($objectName);
//        } else if ($slug && $slug == 'add') {
//            $this->breadcrumbs[$objectName.'s/add'] = trans('admin.adding_'.$objectName);
//            Session::put('breadcrumbs',$this->breadcrumbs);
//            return $this->showView($objectName);
//        } else {
//            $this->data['items'] = $descField ? $model->orderBy($descField,'desc')->get() : $model->all();
//            return $this->showView($objectName.'s');
//        }
//    }
//
//    private function editObject(Request $request, Model $model, array $validationArr, array $checkboxFields = [], array $ignoreFields = [], array $timeFields = [], array $colorFields = [], $imageFolder=null)
//    {
//        $fields = $this->processingFields($request, $checkboxFields, $ignoreFields, $timeFields, $colorFields);
//        if ((isset($validationArr['image']) || isset($validationArr['icon'])) && $imageFolder) $imageField = isset($validationArr['image']) ? 'image' : 'icon';
//        else $imageField = null;
//
//        if ($request->has('id')) {
//            $validationArr['id'] = 'required|integer|exists:'.$model->getTable().',id';
//            $this->validate($request, $validationArr);
//            if ($errorMessage = $this->checkTimeFields($model, $fields)) return back()->withInput()->withErrors([$errorMessage['field'] => $errorMessage['error']]);
//            $item = $model->find($request->input('id'));
//            $item->update($fields);
//        } else {
//            if ($imageField) $validationArr[$imageField] = 'required|'.$validationArr[$imageField];
//            $this->validate($request, $validationArr);
//            if ($errorMessage = $this->checkTimeFields($model, $fields)) return back()->withInput()->withErrors([$errorMessage['field'] => $errorMessage['error']]);
//            $item = $model->create($fields);
//        }
//
//        if ($imageField && $request->hasFile($imageField)) {
//            $userFields = $this->processingImage($request, $item, $imageField, $model->getTable().$item->id, 'images/'.$imageFolder);
//            $item->update($userFields);
//        }
//
//        $breadcrumbs = Session::get('breadcrumbs');
//        $breadcrumbsCounter = 0;
//        $returnUri = '';
//        foreach ($breadcrumbs as $uri => $name) {
//            if ($breadcrumbsCounter == count($breadcrumbs)-2) {
//                $returnUri = $uri;
//                break;
//            }
//            $breadcrumbsCounter++;
//        }
//        return redirect('/admin/'.$returnUri)->with('message',trans('content.save_complete'));
//    }
//
//    private function checkTimeFields(Model $model, array $fields)
//    {
//        if ($model instanceOf Action) {
//            if ($fields['start'] >= $fields['end']) return ['field' => 'start','error' => trans('validation.action_time_start_error')];
//            elseif ($fields['end'] < $fields['start']) return ['field' => 'start','error' => trans('validation.action_time_end_error')];
//            else return false;
//        } else return false;
//    }
//    
//    private function getSubMenu(Model $model, $prefix, $nameField='name', $slugMode=true)
//    {
//        $subMenu = [];
//        $items = $model->all();
//        foreach ($items as $item) {
//            $subMenu[] = ['href' => $prefix.'/'.($slugMode ? $item->slug : '?id='.$item->id), 'name' => $item[$nameField]];
//        }
//        return $subMenu;
//    }
//
//    public function showView($view)
//    {
//        $menus = [
//            ['href' => 'users', 'name' => trans('admin.users'), 'icon' => 'icon-users'],
//            ['href' => 'product_groups', 'name' => trans('admin.product_groups'), 'icon' => ' icon-bookmark', 'submenu' => $this->getSubMenu(new ProductGroup(), 'catalogue')],
//            ['href' => 'products', 'name' => trans('admin.products'), 'icon' => ' icon-cart2'],
//            ['href' => 'orders', 'name' => trans('admin.orders'), 'icon' => ' icon-cart-add2'],
//            ['href' => 'actions', 'name' => trans('admin.actions'), 'icon' => ' icon-hour-glass', 'submenu' => $this->getSubMenu(new Action(), 'actions')],
//            ['href' => 'slides', 'name' => trans('admin.slides'), 'icon' => 'icon-images2', 'submenu' => $this->getSubMenu(new Slide(), 'slides', 'head', true)],
//            ['href' => 'chapters', 'name' => trans('admin.chapters'), 'icon' => 'icon-books', 'submenu' => $this->getSubMenu(new Chapter(), 'chapters')],
//            ['href' => 'stations', 'name' => trans('admin.stations'), 'icon' => 'icon-train2'],
//            ['href' => 'seo', 'name' => 'SEO', 'icon' => 'icon-price-tags'],
//            ['href' => 'settings', 'name' => trans('admin.settings'), 'icon' => 'icon-gear'],
//        ];
//
//        return view('admin.'.$view, [
//            'breadcrumbs' => $this->breadcrumbs,
//            'data' => $this->data,
//            'menus' => $menus,
////            'messages' => Message::where('for_admin',1)->where('read',null)->get()
//        ]);
//    }
}