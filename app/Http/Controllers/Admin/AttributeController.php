<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeOptionRequest;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function __construct()
    {
        $this->data['types'] = Attribute::types();
        $this->data['booleanOptions'] = Attribute::booleanOptions();
        $this->data['validations'] = Attribute::validations();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['attributes'] = Attribute::orderBy('name', 'ASC')->paginate(10);
        return view('admin.attributes.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['attributes'] = null;
        return view('admin.attributes.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_configurable'] = (bool) $params['is_configurable'];
        $params['is_filterable'] = (bool) $params['is_filterable'];

        if (Attribute::create($params)) {
            Session::flash('success', 'Attribute has been saved');
        } else {
            Session::flash('error', 'Attribute could not been saved');
        }
        return redirect('admin/attributes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        $this->data['attribute'] = $attribute;
        return view('admin.attributes.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_configurable'] = (bool) $params['is_configurable'];
        $params['is_filterable'] = (bool) $params['is_filterable'];

        unset($params['code']);
        unset($params['type']);

        $attribute = Attribute::findOrFail($id);

        if ($attribute->update($params)) {
            Session::flash('success', 'Attribute has been saved');
        } else {
            Session::flash('error', 'Attribute could not been saved');
        }
        return redirect('admin/attributes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        if ($attribute->delete()) {
            Session::flash('success', 'Attribute has been deleted');
        } else {
            Session::flash('error', 'Attribute could not been deleted');
        }

        return redirect('admin/attributes');
    }

    public function options($attributeId)
    {
        if (empty($attributeId)) {
            return redirect('admin/attributes');
        }

        $attribute = Attribute::findOrFail($attributeId);
        $this->data['attribute'] = $attribute;

        return view('admin.attributes.options', $this->data);
    }

    public function storeOption(AttributeOptionRequest $request, $attributeId)
    {
        if (empty($attributeId)) {
            return redirect('admin/attributes');
        }

        $params = [
            'attribute_id' => $attributeId,
            'name' => $request->get('name')
        ];

        if (AttributeOption::create($params)) {
            Session::flash('success', 'Option has been saved');
        } else {
            Session::flash('error', 'Option could not been saved');
        }
        return redirect('admin/attributes/' . $attributeId . '/options');
    }

    public function removeOption($optionId)
    {
        if (empty($optionId)) {
            return redirect('admin/attributes');
        }
        $option = AttributeOption::findOrFail($optionId);
        if ($option->delete()) {
            Session::flash('success', 'Option has been deleted');
        } else {
            Session::flash('error', 'Option could not been deleted');
        }

        return redirect('admin/attributes/' . $option->attribute->id . '/options');
    }

    public function editOption($optionId)
    {
        $option = AttributeOption::findOrFail($optionId);

        $this->data['attributeOption'] = $option;
        $this->data['attribute'] = $option->attribute;

        return view('admin.attributes.options', $this->data);
    }

    public function updateOption(AttributeOptionRequest $request, $optionId)
    {
        $option = AttributeOption::findOrFail($optionId);
        $params = $request->except('_token');

        if ($option->update($params)) {
            Session::flash('success', 'Option has been updated');
        } else {
            Session::flash('error', 'Option could not been updated');
        }
        return redirect('admin/attributes/' . $option->attribute->id . '/options');
    }
}
