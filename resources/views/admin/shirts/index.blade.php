<?php

use App\admin\Category;
?>
@extends('admin.layout.admin')

@section('content')
<head>
	<link rel="stylesheet" href="{{asset('css/table.css')}}">
</head>
<h3>Shirts Products</h3>
<table class="table" id="customers">
	<thead>
		<tr>
			<th>ID</th>
			<th >Name</th>
			<th>Description</th>
			<th >Size</th>
			<th>Price</th>
			<th>Backkground Image</th>
			<th>Category Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@forelse($shirts as $shirt)
			<tr>
				<td> <h4>{{$shirt->id}}</h4> </td>
				<td> <h4>{{$shirt->name}}</h4> </td>	
				<td> <h4>{{$shirt->description}}</h4> </td>
				<td> <h4>{{$shirt->size}}</h4> </td>
				<td> <h4>{{$shirt->price}} </h4> </td>
				<td> <img class="img-responsive" src="/storage/photos/shirts/{{$shirt->image}}"></td>

				<td> <h4>
					<?php $cate = Category::find($shirt->category_id);
					?>
					{{ $cate->name}} 
	
				</h4></td>
				
				<td>					
					<a href="{{route('shirts.edit',$shirt->id)}}" class="btn btn-default" style="margin-bottom: 15px;">Edit</a>
					
					{{-- delete button --}}
			        <form action="{{route('shirts.destroy',$shirt->id)}}"  method="POST">
			           	{{csrf_field()}}
			            {{method_field('DELETE')}}
			            <input class="btn btn-sm btn-danger" type="submit" value="Delete">
			        </form>
		        </td>
	        </tr>
		@empty
			<h4>No products has been added</h4>	
		@endforelse	

	</tbody>
</table>

@endsection