<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RuleRequest;
use App\Services\NavigateService;
use Illuminate\Http\Request;

class NavigateController extends BaseController
{
    protected $NavigateService;

    /**
     * RulesController constructor.
     * @param NavigateService $NavigateService
     */
    public function __construct(NavigateService $NavigateService)
    {
        $this->NavigateService = $NavigateService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rules = $this->NavigateService->getRulesTree();

        \Debugbar::info('test');

        return $this->view(null,compact('rules'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $rules = $this->NavigateService->getRulesTree();

        return $this->view(null,compact('rules'));
    }

    /**
     * @param RuleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RuleRequest $request)
    {
        $this->NavigateService->create($request->all());

        flash('添加权限成功')->success()->important();

        return redirect()->route('navigate.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $rules = $this->NavigateService->getRulesTree();
        $rule = $this->NavigateService->ById($id);

        return $this->view(null,compact('rule','rules'));
    }

    /**
     * @param RuleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RuleRequest $request, $id)
    {
        $rule = $this->NavigateService->ById($id);
        \Debugbar::info($rule);
        if(is_null($rule))
        {
            flash('你无权操作')->error()->important();
        }

        $rule->update($request->all());
        flash('更新成功')->success()->important();

        return redirect()->route('navigate.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $rule = $this->NavigateService->ById($id);

        if(empty($rule))
        {
            flash('删除失败')->error()->important();

            return redirect()->route('navigate.index');
        }

        $rule->delete();

        flash('删除成功')->success()->important();

        return redirect()->route('navigate.index');
    }

    /**
     * @param $status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($status,$id)
    {
        $rule = $this->NavigateService->ById($id);

        if(empty($rule))
        {
            flash('操作失败')->error()->important();

            return redirect()->route('navigate.index');
        }

        $rule->update(['is_hidden'=>$status]);

        flash('更新状态成功')->success()->important();

        return redirect()->route('navigate.index');
    }
}
