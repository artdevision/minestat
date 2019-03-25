<table class="table table-responsive" id="rigs-table">
    <thead>
        <tr>
            <th>On</th>
            <th>V</th>
            <th>Name</th>
            <th>Loc</th>
            <th>IP</th>
            <th>M</th>
            <th>Driver</th>
            <th>Kernel</th>

            <th>CPU t</th>
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
            <th>Volts</th>
            <th>Watts</th>
            <th>Core</th>
            <th>Mem</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($rigs as $rig)
        @php
        $temp_class = $rig->state->cpu_temp < 45 ? 'bg-green' : 'bg-red';

        @endphp
        <tr>
            <td><i class="fa fa-fw fa-power-off {!! $rig->online ? 'text-green' : 'text-red' !!}"></i></td>
            <td>{!! $rig->version !!}</td>
            <td>{!! $rig->hostname !!}</td>
            <td>{!! $rig->rack_loc !!}</td>
            <td><a href="http://{!! $rig->ip !!}"
                   data-placement="right"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="{!! $rig->pool_info !!}">
                    {!! $rig->ip !!}</a></td>
            <td><a href="#"
                   data-placement="right"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="{!! $rig->miner !!}">
                    {!! substr($rig->miner, 0, 2) !!}</a></td>
            <td>{!! $rig->driver !!}</td>
            <td>{!! $rig->kernel !!}</td>
            <td><a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'cpu_temp']) }}">
                    <small class="label {!! $temp_class !!}">
                        {!! $rig->state->cpu_temp !!}
                    </small>
                </a>
            </td>
            <td><a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'uptime']) }}"><small>{!! $rig::timeForHuman($rig->state->uptime) !!}</small></a></td>
            <td><a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'miner_secs']) }}"><small>{!! $rig::timeForHuman($rig->state->miner_secs) !!}</small></a></td>
            <td><a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'freespace']) }}"><small>{!! $rig->state->freespace !!}</small></a></td>
            <td><a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'hash']) }}"><small>{!! $rig->state->hash !!}</small></a></td>
            <td><a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'miner_hashes']) }}">
                @if(is_array($rig->state->miner_hashes))
                    @foreach($rig->state->miner_hashes as $val)
                            <small class="text-green">{!! $val !!}</small>
                    @endforeach
                @endif
                </a>
            </td>
            <td>
                <a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'temp']) }}">
                    @if(is_array($rig->state->temp))
                        @foreach($rig->state->temp as $val)
                            <small class="label {{ color_gpu($val) }}">{!! $val !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'voltage']) }}">
                    @if(is_array($rig->state->voltage))
                        @foreach($rig->state->voltage as $val)
                            <small class="text-green">{!! $val !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'watts']) }}"
                   data-placement="left"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Default Watts: {!! is_array($rig->state->default_watts) ? implode(' ', $rig->state->default_watts) : '' !!}
                        Min Watts: {!! is_array($rig->state->wats_min) ? implode(' ', $rig->state->wats_min) : '' !!}
                        Max Watts: {!! is_array($rig->state->wats_max) ? implode(' ', $rig->state->wats_max) : '' !!}
                       "
                >
                    @if(is_array($rig->state->watts))
                        @foreach($rig->state->watts as $val)
                            <small class="text-green">{!! $val !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'core']) }}"
                   data-placement="left"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Default Core: {!! is_array($rig->state->default_core) ? implode('hz ', $rig->state->default_core) : '' !!}hz"
                >
                    @if(is_array($rig->state->core))
                        @foreach($rig->state->core as $val)
                            <small class="text-green">{!! $val / 1000 !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                <a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'mem']) }}"
                   data-placement="left"
                   data-tooltip="tooltip"
                   data-toggle="tooltip"
                   data-original-title="Default Core: {!! is_array($rig->state->default_mem) ? implode('hz ', $rig->state->default_mem) : '' !!}hz"
                >
                    @if(is_array($rig->state->mem))
                        @foreach($rig->state->mem as $val)
                            <small class="text-green">{!! $val / 1000 !!}</small>
                        @endforeach
                    @endif
                </a>
            </td>
            <td>
                {!! Form::open(['route' => ['cabinet.rigs.destroy', $rig->id], 'method' => 'delete']) !!}
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
