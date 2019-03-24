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
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($rigs as $rig)
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
            <td>{!! $rig->state->cpu_temp !!}</td>
            <td>{!! $rig::timeForHuman($rig->state->uptime) !!}</td>
            <td>{!! $rig::timeForHuman($rig->state->miner_secs) !!}</td>
            <td>{!! $rig->state->freespace !!}</td>
            <td>{!! $rig->state->hash !!}</td>
            <td><a href="{{ route('cabinet.chart', ['id' => $rig->getKey(), 'field' => 'miner_hashes']) }}">{!! is_array($rig->state->miner_hashes) ? implode('|',$rig->state->miner_hashes) : '' !!}</td>
            <td>{!! is_array($rig->state->temp) ? implode('|', $rig->state->temp) : '' !!}</td>
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
