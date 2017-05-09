<template lang="html">
    <div class="container">
        <div class="row">
			<div class="col-md-8">
		        <form v-on:submit.prevent="addList" class="form-horizontal" role="form" action="#" method="POST" >
		            <input type="text" name="listname" autocomplete="off"  id="listname" maxlength="255" v-model="listname" size="32" placeholder="Create List" />
		        </form>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="wrapper">
			      	<div class="task-list" v-for="list in lists">
			      		<span>{{ list.name }}</span>
			      		<div>
				      		<a href="#"><span class="glyphicon glyphicon-plus"></span></a>
				      		<a href="#"><span class="glyphicon glyphicon-cog"></span></a>
			      		</div>
			      		<div class="dragula-container">
				        	<div v-for="item in list.task">{{ item.name }}</div>
			      		</div>
			        </div>
			    </div>
			</div>
		</div>
    </div>
</template>

<script>
    export default {
    	props: ['init_board','init_lists'],
    	data() {
    		return {
				listname: '',
				board: this.init_board,
				lists: this.init_lists
    		}
    	},
        mounted() {
        	var containers = $('.dragula-container').toArray();
			dragula(containers, {
			  isContainer: function (el) {
			    return el.classList.contains('dragula-container'); // only elements in drake.containers will be taken into account
			  },
			  moves: function (el, source, handle, sibling) {
			    return true; // elements are always draggable by default
			  },
			  accepts: function (el, target, source, sibling) {
			    return true; // elements can be dropped in any of the `containers` by default
			  },
			  invalid: function (el, handle) {
			    return false; // don't prevent any drags from initiating by default
			  },
			  direction: 'vertical',             // Y axis is considered when determining where an element would be dropped
			  copy: false,                       // elements are moved by default, not copied
			  copySortSource: false,             // elements in copy-source containers can be reordered
			  revertOnSpill: false,              // spilling will put the element back where it was dragged from, if this is true
			  removeOnSpill: false,              // spilling will `.remove` the element, if this is true
			  mirrorContainer: document.body,    // set the element that gets mirror elements appended
			  ignoreInputTextSelection: true     // allows users to select input text, see details below
			});
        },
        methods: {
		    addList: function() {
                axios.post('/board/board_list', {
                    listname: this.listname,
                    board_id: this.board.id
                }).then( response => 
                    this.lists = response.data,
                    this.listname = ''
                );
            }
	  	}
    }
</script>
<style lang="css">
	
</style>