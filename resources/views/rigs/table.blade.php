@php
    use Illuminate\Support\Facades\Cache;
    $sort = request()->get('sort', ['rack_loc' => 'asc']);
    $rigs = Cache::remember('rig-list-serialized-' . key($sort) . ':' . current($sort) , 120, function () use($rigs) {
        return $rigs->toArray();
    });

    //dd($rigs['data'][0]['state']);
@endphp
<table class="table table-responsive" id="rigs-table">
    <thead>
        <tr>
            <th><a href="?sort[updated_at]={!! (!is_null($sort) &&  isset($sort['updated_at']) && $sort['updated_at'] == 'asc') ? 'desc' : 'asc' !!}">On</a></th>
            <th>V</th>
            <th><a href="?sort[hostname]={!! (!is_null($sort) &&  isset($sort['hostname']) && $sort['hostname'] == 'asc') ? 'desc' : 'asc' !!}">Name</a></th>
            <th><a href="?sort[rack_loc]={!! (!is_null($sort) &&  isset($sort['rack_loc']) && $sort['rack_loc'] == 'asc') ? 'desc' : 'asc' !!}">Loc</a></th>
            <th>IP</th>
            <th><a href="?sort[miner]={!! (!is_null($sort) &&  isset($sort['miner']) && $sort['miner'] == 'asc') ? 'desc' : 'asc' !!}">M</a></th>
            <th><a href="?sort[driver]={!! (!is_null($sort) &&  isset($sort['driver']) && $sort['   driver'] == 'asc') ? 'desc' : 'asc' !!}">Driver</a></th>

            <th>CPU t</th>
            <th><a href="?sort[updated_at]={!! (!is_null($sort) &&  isset($sort['updated_at']) && $sort['updated_at'] == 'asc') ? 'desc' : 'asc' !!}"
                   data-placement="right"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Last Ping" >p</a>
            </th>
            <th><a href="#"
                   data-placement="right"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Rig UpTime" >b</a>
            </th>
            <th><a href="#"
                   data-placement="right"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Miner Running Time" >m</a>
            </th>
            <th>Free Space</th>
            <th><a href="#" data-placement="right" data-tooltip="tooltip" data-toggle="tooltip" data-original-title="Total hashrate" >Hr</a></th>
            <th>Hashes</th>
            <th>Temps</th>
            <th>Ptune</th>
            <th>Volts</th>
            <th>Watts</th>
            <th>Core</th>
            <th>Mem</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($rigs['data'] as $rig)
        @php
        $state = $rig['state'];
        $temp_class = (isset($state['cpu_temp']) && $state['cpu_temp'] < 45)  ? 'bg-green' : 'bg-red';
        $key = $rig['_id'];

        @endphp
        <tr>
            <td><i class="fa fa-fw {!! $rig['online'] ? 'fa-power-off text-green' : 'fa-close text-red' !!}"></i></td>
            <td>{!! $rig['version'] !!}</td>
            <td>{!! $rig['hostname'] !!}</td>
            <td>{!! $rig['rack_loc'] !!}</td>
            <td><a href="http://{!! $rig['ip'] !!}"
                   data-placement="right"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="{!! $rig['pool_info'] !!}">
                    {!! $rig['ip'] !!}</a></td>
            <td><a href="#"
                   data-placement="right"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="{!! $rig['miner'] !!}">
                    {!! substr($rig['miner'], 0, 2) !!}</a></td>
            <td>{!! $rig['driver'] !!}</td>
            <td><a href="/cabinet/chart/{{ $key }}/cpu_temp">
                    <small class="label {!! $temp_class !!}">
                        {!! isset($state['cpu_temp']) ? $state['cpu_temp'] : ''!!}
                    </small>
                </a>
            </td>
            <td><a href="#"><small>{!! $rig['last_ping'] !!}</small></a></td>
            <td><a href="/cabinet/chart/{{ $key }}/uptime"><small>{!! $state['uptime'] !!}</small></a></td>
            <td><a href="/cabinet/chart/{{ $key }}/miner_secs"><small>{!! $state['miner_secs'] !!}</small></a></td>
            <td><a href="/cabinet/chart/{{ $key }}/freespace"><small>{!! $state['freespace'] !!}</small></a></td>
            <td><a href="/cabinet/chart/{{ $key }}/hash"><small>{!! $state['hash'] !!}</small></a></td>
            <td><a href="/cabinet/chart/{{ $key }}/miner_hashes">
                @if(is_array($state['miner_hashes']))
                    @foreach($state['miner_hashes'] as $val)
                            <small class="text-green">{!! $val !!}</small>
                    @endforeach
                @endif
                </a>
            </td>
            <td>
                <a href="/cabinet/chart/{{ $key }}/temp">
                    @if(is_array($state['temp']))
                        @foreach($state['temp'] as $val)
                            <small class="label {{ color_gpu($val) }}">{!! $val !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="/cabinet/chart/{{ $key }}/powertune">
                    @if(is_array($state['powertune']))
                        @foreach($state['powertune'] as $val)
                            <small class="text-green">{!! $val !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="/cabinet/chart/{{ $key }}/voltage">
                    @if(is_array($state['voltage']))
                        @foreach($state['voltage'] as $val)
                            <small class="text-green">{!! $val !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="/cabinet/chart/{{ $key }}/watts"
                   data-placement="left"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Default Watts: {!! is_array($state['default_watts']) ? implode(' ', $state['default_watts']) : '' !!}
                        Min Watts: {!! is_array($state['watt_min']) ? implode(' ', $state['watt_min']) : '' !!}
                        Max Watts: {!! is_array($state['watt_max']) ? implode(' ', $state['watt_max']) : '' !!}
                       "
                >
                    @if(is_array($state['watts']))
                        @foreach($state['watts'] as $val)
                            <small class="text-green">{!! $val !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="/cabinet/chart/{{ $key }}/core"
                   data-placement="left"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Default Core: {!! is_array($state['default_core']) ? implode('hz ', $state['default_core']) : '' !!}hz"
                >
                    @if(is_array($state['core']))
                        @foreach($state['core'] as $val)
                            <small class="text-green">{!! $val / 1000 !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="/cabinet/chart/{{ $key }}/mem"
                   data-placement="left"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Default Core: {!! is_array($state['default_mem']) ? implode('hz ', $state['default_mem']) : '' !!}hz"
                >
                    @if(is_array($state['mem']))
                        @foreach($state['mem'] as $val)
                            <small class="text-green">{!! $val / 1000 !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                {!! Form::open(['route' => ['cabinet.rigs.destroy', $key], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--
                    <a href="{!! route('rigs.show', [$rig->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('rigs.edit', [$rig->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    --}}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
