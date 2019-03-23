<li class="{{ Request::is('cabinet/rigs*') ? 'active' : '' }}">
    <a href="{!! route('cabinet.rigs') !!}"><i class="fa fa-server"></i><span>Rigs</span></a>
</li>
<li class="{{ Request::is('cabinet/config*') ? 'active' : '' }}">
    <a href="{!! route('cabinet.rigs') !!}"><i class="fa fa-edit"></i><span>Config</span></a>
</li>

