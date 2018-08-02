<template>
      <div>
        <div class="card-body form-group" id="scroll">
          <h6 align="right" class='form-control' v-for='message in messages'><h2 v-bind:class='color()'>{{ message.message}} </h2></h6><span class='badge badge-light float-right'> {{ message.user_id }}</span>
        </div>
        <input class="form-control" type="text" name="message" @keyup.enter = 'send' placeholder="You'r message" v-model.trim = 'message'>
      </div>
</template>

<script>
  export default{
    data() {
      return{
        messages :[],
        message : '',
      }
    },

    // computed: {
    //     color: function() {
    //         return 'form-control bg-danger text-white text-right';
    //     }
    // },

    updated(){
      var elem = this.$el.querySelector("#scroll");
      elem.scrollTop = elem.scrollHeight;
    },
    created() {
      this.fletchMessages()
    },

    methods : {
      color(){
      //  var qwe ={e:''};
          // console.log(this.messages.length);
          for (var i = 0; i < this.messages.length; i++) {
            //console.log(this.messages[i].user_id);
            if (this.messages[i].user_id == 'Hello') {
              var qwe = 'bg-danger';
               return qwe;

            //  console.log(this.color.color);
            }else{

              var qwe = ''
               return qwe;
            }
          }

        // if (this.messages[1].user_id == 'Hello') {
        //   return 'form-control bg-danger text-white'
        // }else{
        //
        //   return 'form-control bg-warning text-white'
        // }
          //bg-info text-white text-right
      },

      send(){
        if (this.message) {
          const friendId = $('meta[name="friendId"]').attr('content');
          Echo.private('Chat.' + friendId)
            .listen('BroadcastChat',(e) => {
              console.log(e);
            });
          let mesage = {
            user_id : '',
            friend_id : $('meta[name="friendId"]').attr('content'),
            message  : this.message
          }
          axios.post("/user" , mesage).then(response =>{
            this.messages.push(mesage);
            this.message='';
          })
        }
      },
      fletchMessages(){
        const friendId = $('meta[name="friendId"]').attr('content');
        const userId = $('meta[name="userId"]').attr('content');
        axios.get("/user/"+friendId).then(response => {
              this.messages = response.data;
              console.log(response.data);
            });

            Echo.private(`Chat.` + friendId + '.' + userId)
                .listen('BroadcastChat', (e) => {
                  this.messages.push(e.message);
                  console.log(e);
                });
      }
    }
  }
</script>

<style media="screen">
  #scroll{
    overflow: auto;
    height: 300px;
  }
</style>
