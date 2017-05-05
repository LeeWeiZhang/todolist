@extends('layouts.app')

@section('content')
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading dashboard-header">
                    <form  v-on:submit.prevent="addBoard" class="form-horizontal" role="form" action="#" method="POST" >
                        <input type="text" name="board_name" id="board_name" maxlength="255" v-model="new_board_name" size="32" placeholder="Create Board" />
                    </form>
                </div>
                <div class="panel-body dashboard-body" v-bind:class="{ 'background-meme-forever-alone': empty_board }">
                    <span v-if="this.boards.length < 1">Dashboard is empty, please create a board to fill in it.</span>
                    <div id="boards">
                        <a :href="'{{ url('board') }}/' + board.id" class="list-group-item" v-for="board in boards">
                            <h4 class="list-group-item-heading">@{{ board.name }}</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
window.onload = function () {
    var app = new Vue({
        el: '#app',
        data: {
            new_board_name: '',
            boards: {!! $boards !!},
            empty_board: {{ (count($boards) == 0) ? 'true' : 'false' }}
        },
        methods: {
            addBoard: function () {
                axios.post('/board',{
                    name: this.new_board_name
                }).then( response => 
                    this.boards = response.data,
                    this.new_board_name = ''
                );
            }
        },
        watch: {
            'boards':function(){
                this.empty_board = (this.boards.length > 0 ? false : true);
            }
        }
    });
}
</script>
