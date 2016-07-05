@extends('store.store')

@section('categories')
    @include('store.partial.account')
@endsection

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Your Account</h2>
            <section id="cart_items">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed table-striped">
                        <thead>
                        <tr class="cart_menu">
                            <td colspan="2">Account information</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-right">
                                Account created:
                            </td>
                            <td>
                                {{ date('F d, Y', strtotime($user->created_at)) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Name:
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                E-mail:
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div><!--features_items-->
    </div>
@endsection
