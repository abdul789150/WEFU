@extends('layouts.app')

@section('content')

    <div class="col-lg-10 float-right">

        <a href="{{route('completedOrders')}}" class="btn btn-outline-purple">Completed Orders</a>
        <a href="{{route('incompleteOrders')}}" class="btn btn-outline-orange">Incomplete Orders</a>

    </div>


@endsection


<script>
    // main()
</script>