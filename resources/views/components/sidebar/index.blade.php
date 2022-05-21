@php
    $transactionNav = [
        'All'     => url('/transactions'), 
        'Pending' => url('/transactions') . '?status=1',
        'Paid'    => url('/transactions') . '?status=2',
    ];
@endphp

<x-sidebar.sidebar theme="dark">
    <x-sidebar.brand 
      img="{{ asset('assets/img/brand.png') }}"
      name="PHRI"
      route="/dashboard" />
  
    <x-sidebar.divider />
  
    <x-sidebar.item
      active="{{ Request::is('dashboard') }}"
      icon="fa-gauge-high"
      name="Dashboard" 
      :route="url('/dashboard')" />
  
    <x-sidebar.collapse-item
      active="{{ Request::is('coins') }}"
      icon="fa-clipboard-list"
      name="Transactions"
      :routes="$transactionNav" />  
    
    <x-sidebar.item
      active="{{ Request::is('users') }}"
      icon="fa-users"
      name="Users"
      :route="url('/users')" />  
  
    <x-sidebar.divider mb="4"/>
    
    <x-sidebar.toggle/> 
  </x-sidebar.sidebar>