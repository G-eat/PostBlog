<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header"><h2 class="text-info">Chat</h2></div>

        <div class="card-body form-group" id="scroll">
          <h6 class="form-control bg-info text-white text-right" v-for='message in messages'>{{ message}}</h6>
        </div>
        <input class="form-control" type="text" name="message" @keyup.enter = 'send' placeholder="You'r message" v-model.trim = 'message'>
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    data() {
      return{
        messages :[],
        message : ''
      }
    },
    updated(){
      var elem = this.$el.querySelector("#scroll");
      elem.scrollTop = elem.scrollHeight;
      console.log(elem.scrollTop);
    },

    methods : {
      send(){
        if (this.message) {
          this.messages.push(this.message);
          this.message ='';
        }
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
