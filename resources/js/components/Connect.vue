<template>
  <div class="bg-green-400 p-4 text-gray-900 rounded">
      <span>{{ this.msg }}</span>
      <span>Okay</span>
      <div class="my-4">
        <span class="bg-gray-900 font-semibold p-2 text-white text-center rounded" v-on:click="toggleUserMessage('users')">Show users</span>
        <span class="bg-gray-900 font-semibold p-2 text-white text-center rounded" v-on:click="toggleUserMessage('messages')">Show Messages</span>
      </div>

      <div class="bg-red-100 p-4 rounded text-black" v-show="this.showUsers">
          <h2 class=" bg-blue-400 text-red-900 font-semibold p-2 shadow shadow-md">
            Users
          </h2>
          <div class="mt-4 p-4 bg-green-400 text-gray-900" v-for="user in this.users" v-bind:key="user.id">
              <span class="p-2 mt-2.bg-red-100.text-black">{{ user.name }}</span>

              <button v-if="auth_id != user.id" class="float-right bg-green-400" v-on:click="privateChat( user.id )">Chat</button>
          </div>
      </div>

      <div class="bg-red-100 p-4 rounded text-black h-screen" v-show="this.showMessages" id="list_messages">
          <h2 class=" bg-blue-400 text-red-900 font-semibold p-2 shadow shadow-md text-center">
              Messages
          </h2>
          <div class="" v-for="message in this.messages" v-bind:key="message.id">
              <div v-if="message.sent_id == auth_id" class=" mt-4 p-2 bg-blue-400 text-gray-900 rounded-tr-lg rounded-bl-lg chat-element float-right ">
                <div class="p-1 m-0 bg-red-250 text-gray-600 text-xs float-right">{{ message.sent_by }}</div>
                <div class="p-1 mt-1 bg-red-250 text-black">{{ message.content }}</div>
              </div>
              <div class="mt-4 p-2 bg-green-400 text-gray-900 rounded-tr-lg rounded-bl-lg chat-element float-left" v-else>
                <div class="p-1 m-0 bg-red-250 text-gray-600 text-xs float-right">{{ message.sent_by }}</div>
                <div class="p-1 mt-1 bg-red-250 text-black">{{ message.content }}</div>
              </div>
          </div>
      </div>

      <div v-show="this.showMessages" class="bg-red-100 p-4 ">
        <div class="mt-4 p-2 bg-green-400 button-circle"  id="angle-down">
            <button v-on:click="scrollMessageToBottom()"><i class="fas fa-angle-double-down hover:text-red-250" style="font-size: 1.5rem;"></i></button>
        </div>
        <div>
            <span>
                <input type="text" name="content" v-model="content" class="mt-4 p-2 bg-blue-400 text-gray-900  chat-message-input ">
            </span>
            <span class="mt-4 p-2 bg-blue-400 button-circle float-right" id="paper-plane">
                <button v-on:click="post_message()"><i class="fas fa-paper-plane hover:text-red-250" style="font-size: 1.5rem;"></i></button>
            </span>

        </div>
      </div>

      <div class="bg-red-100 p-4 rounded text-black h-screen" v-show="this.showPrivateChat" id="list_private_messages">
          <h2 class=" bg-blue-400 text-red-900 font-semibold p-2 shadow shadow-md text-center">
              Messages
          </h2>
          <div class="" v-for="message in this.p_messages" v-bind:key="message.id">
              <div v-if="message.sent_id == auth_id" class=" mt-4 p-2 bg-blue-400 text-gray-900 rounded-tr-lg rounded-bl-lg chat-element float-right ">
                <div class="p-1 m-0 bg-red-250 text-gray-600 text-xs float-right">{{ message.sent_by }}</div>
                <div class="p-1 mt-1 bg-red-250 text-black">{{ message.content }}</div>
              </div>
              <div class="mt-4 p-2 bg-green-400 text-gray-900 rounded-tr-lg rounded-bl-lg chat-element float-left" v-else>
                <div class="p-1 m-0 bg-red-250 text-gray-600 text-xs float-right">{{ message.sent_by }}</div>
                <div class="p-1 mt-1 bg-red-250 text-black">{{ message.content }}</div>
              </div>
          </div>
      </div>

      <div v-show="this.showPrivateChat" class="bg-red-100 p-4 ">
        <div class="mt-4 p-2 bg-green-400 button-circle"  id="angle-down">
            <button v-on:click="scrollMessageToBottom('list_private_messages')"><i class="fas fa-angle-double-down hover:text-red-250" style="font-size: 1.5rem;"></i></button>
        </div>
        <div>
            <span>
                <input type="text" name="content" v-model="content" class="mt-4 p-2 bg-blue-400 text-gray-900  chat-message-input ">
            </span>
            <span class="mt-4 p-2 bg-blue-400 button-circle float-right" id="paper-plane">
                <button v-on:click="post_message()"><i class="fas fa-paper-plane hover:text-red-250" style="font-size: 1.5rem;"></i></button>
            </span>

        </div>
      </div>

  </div>
</template>

<script>
export default {
    data() {
        return {
            msg: 'Gowthammm',
            users: [],
            messages: [],
            p_messages: [],
            showUsers: true,
            showMessages: false,
            showPrivateChat: false,
            content: '',
            auth_id: document.querySelector('#auth_id').value,
            page: 1,
            isMoreMessageAvailable: true,
            chat_with: 0,
        }
    },
    created() {
        // this.getAllMessages();
    },
    mounted() {
        console.log(this.message);
        this.listenUser();

        var list_element = document.querySelector('#list_messages');
        var vm = this;
        list_element.onscroll = function(e) {
            
            if(e.target.scrollTop == 0) {
                console.log('All Messages Loaded');
                // console.log(`scroll event  :  ${e.target.scrollTop}     ${e.target.scrollHeight}`);
                var status = vm.loadMoreMessages()
            }
        }
    },
    methods: {
        listenUser(type) {
            console.log('listening');

            // Echo.private('the-private-channel')
            // Echo.channel('the-presence-channel')
            // Echo.channel('the-private-channel')
            // Echo.join('the-presence-channel')
            //     .listen('BroadcastMessage', (e) => {
            //         console.log(e);
            //         console.log('inside listen of ECHO');
            //     });

            var vm = this;
            console.log('------------------- OUTSIDE')
            console.log(this);
            console.log('-------------------')

            Echo.join('the-presence-channel-user')
                .here(users => {
                    this.users = users
                    console.log(this.users.messages);
                    
                    console.log('here        :'+type)
                })
                .joining(user => {
                    this.users.push(user)
                    console.log('joining')

                })
                .leaving(user => {
                    (this.users = this.users.filter(u => (u.id !== user.id)))
                    console.log('leaving')
                })

            Echo.private('the-private-channel-user')
                .listen('.new.message', function(e) {
                    console.log('got new message')
                    
                    console.log(e);
                    
                    var auth_id = document.querySelector('#auth_id').value;
                    // console.log(e.received_id, auth_id, e.received_id == auth_id);
                    var idName = 'list_messages';
                    if(e.received_id == 0) {
                        vm.messages.push(e);
                    }
                    if(e.received_id == auth_id) {
                        vm.p_messages.push(e);
                        idName = 'list_private_messages';
                        setTimeout(() => {
                            vm.scrollMessageToBottom(idName);
                        }, 1500);
                    }

                    // window.scrollTop = window.scrollHeight;

                });

            // Echo.private(`the-private-channel-user`)
            //     .listen(`.new.message.${auth_id}`, function(e) {
            //         console.log('got new PRIVATE message')
                    
            //         vm.p_messages.push(e);
            //     });

            // Echo.channel('the-presence-channel.'+type)
            //     .listen('NewMessage', function(e) {
            //         console.log('got new message')
            //         // this.message.push(e.message);
            //         console.log(e);
                    
            //     });

            console.log('end of listent')
        }, 
        post_message() {
            var vm = this;
            var data = {
                content: this.content
            };
            if(this.showPrivateChat == true && this.showMessages == false) {
                data['received_id'] = this.chat_with;
            }
            
            axios.post('post-message', data)
                .then(resp => {
                    console.log('then');
                    // this.messages.push(resp.data.message);

                    this.content = '';
                    
                    if(this.showPrivateChat == true && this.showMessages == false) {
                        this.p_messages.push(resp.data.message);
                        console.log('THEN P_MESSAGES');
                        
                    } else {
                        console.log('THEN MESSAGES');
                        this.messages.push(resp.data.message);
                    }
                    var id = resp.data.message.id;

                })
                .then(() => {
                    this.scrollMessageToBottom('list_private_messages');
                    this.scrollMessageToBottom('list_messages');
                })
                .catch(err => {
                    console.log('err');
                    console.log(err);

                });
        },
        toggleUserMessage(type) {

            if(type == 'users') {
                this.showUsers = true;
                this.showMessages = false;
                this.showPrivateChat = false;
            } else {
                if(this.showMessages == true) {
                    return null;
                }
                this.showUsers = false;
                this.showMessages = true;
                this.showPrivateChat = false;

                this.page = 1;
                
                if(this.showMessages) {
                    this.page = 1;
                    this.getAllMessages();               
                }
            }

            
        },
        getAllMessages( user_id = null) {
            var query = '';
            var url = '';

            if(this.showPrivateChat == true) {
                query = `?user_id=${user_id}`
                // this.chat_with = user_id;
                console.log('CHAT WITH IS SET')
                url = `all-messages/${this.chat_with}`+query;
            } else {
                url = 'all-messages';
            }

            axios.get(url) //asdf
                .then(resp => {
                    console.log('then');
                    // this.messages = resp.data.messages;
                    console.log(user_id);
                    
                    console.log(resp.data);
                    var response = resp.data;
                    console.log(response);

                    // this.messages = Object.entries(response);
                    if(user_id == null) {
                        this.messages = response;
                    } else {
                        this.p_messages = response;
                        this.showPrivateChat = true;
                        this.showMessages = false;
                        this.showUsers = false;

                    }

                    console.log(this.messages);
                    
                })
                .then(() => {
                    var idName = 'list_messages';
                    
                    if(this.showPrivateChat == true) {
                        var vm = this;

                        idName = 'list_private_messages';
                        document.querySelector('#list_private_messages').onscroll = function(e) {
                            if(e.target.scrollTop == 0) {
                                console.log('All PRIVATE Messages Loaded');
                                // console.log(`scroll event  :  ${e.target.scrollTop}     ${e.target.scrollHeight}`);
                                var status = vm.loadMoreMessages(this.chat_with)
                            }
                        }
                    }
                    this.scrollMessageToBottom(idName);
                })
                .catch(err => {
                    console.log('err');
                    console.log(err);
                });


        }, 
        scrollMessageToBottom(idName = 'list_messages') {
            console.log('scrollMessageToBottom')
            this.jsScrollEnable = false;
            console.log(document.querySelector(`#${idName}`));
            document.querySelector(`#${idName}`).scrollTop = document.querySelector(`#${idName}`).scrollHeight + 200;
            this.jsScrollEnable = true;
        },
        async loadMoreMessages(user_id = null) {


            if(this.isMoreMessageAvailable) {
                this.page++;
                var query = '';
                var url = '';
                if(this.showPrivateChat == false) {
                    url = `all-messages?page=${this.page}`;
                } else {
                    url = `all-messages/${this.chat_with}?user_id=${this.chat_with}&page=${this.page}`

                    // this.chat_with = user_id;
                    console.log('CHAT WITH IS SET');
                    console.log(this.chat_with);                    
                }

                await axios.get(url) //asdf
                    .then(resp => {
                        console.log('then Load More Messages')
                        
                        var response = resp.data;
                        console.log(response);

                        var oldMessageScrollHeight = document.querySelector('#list_messages').scrollHeight;
                        var oldPrivateMessageScrollHeight = document.querySelector('#list_private_messages').scrollHeight;

                        response.forEach(element => {
                            if(this.showPrivateChat == true) {
                                this.p_messages.unshift(element);
                            } else {
                                this.messages.unshift(element);
                            }
                        });                 
                        
                        var status;
                        if(response.length == 0) {
                            console.log('LENGTH IS ZERO');
                            this.isMoreMessageAvailable = false;
                        } else {
                            console.log('LENGTH IS NOT - ZERO');
                            this.isMoreMessageAvailable = true;

                            if(this.showPrivateChat == true) {
                                setTimeout(() => {
                                    console.log('Inside timeout of lsit_priavate_messages')
                                    document.querySelector('#list_private_messages').scrollTop = 
                                        document.querySelector('#list_private_messages').scrollHeight - oldPrivateMessageScrollHeight;// + 70;
                                }, 1500);
                            }

                            if(this.showMessages == true) {
                                setTimeout(() => {
                                    console.log('Inside timeout of lsit_priavate_messages')
                                    document.querySelector('#list_messages').scrollTop = 
                                        document.querySelector('#list_messages').scrollHeight - oldMessageScrollHeight;// + 70;
                                }, 1500);
                            }

                        }
                        
                    })
                    .then(() => {
                        // if(this.showPrivateChat == true) {
                        //     setTimeout(() => {
                        //         console.log('Inside timeout of lsit_priavate_messages')
                        //         document.querySelector('#list_private_messages').scrollTop = 
                        //             document.querySelector('#list_private_messages').scrollHeight - oldScrollHeight;// + 70;
                        //     }, 1500);
                        // }
                        // if(this.showMessages == true) {
                        //     setTimeout(() => {
                        //         console.log('Inside timeout of lsit_priavate_messages')
                        //         document.querySelector('#list_messages').scrollTop = 
                        //             document.querySelector('#list_messages').scrollHeight - oldScrollHeight;// + 70;
                        //     }, 1500);
                        // }
                    })
                    .catch(err => {
                        console.log('err');
                        console.log(err);
                    });
            } else {
                console.log('No more messages');
            }
            
        },
        privateChat( user_id ) {
            console.log('PRIVATE '+user_id);
            this.getAllMessages(user_id);
            this.chat_with = user_id;
        }
    }, 
    computed: {
        // changeMessages: function() {
        //     console.log(this.messages);
        //     console.log('this.messages');
        //     this.messages = this.messages;
        //     return this.messages;
        // }
    }

}
</script>

<style>
.chat-element {
    width: 75%;
}
.chat-message-input {
    width: 90%;
}
#list_messages {
    margin-top: 5px;
    height: 60vh;
    overflow-y: scroll;
}
#list_private_messages {
    margin-top: 5px;
    height: 60vh;
    overflow-y: scroll;
}
.button-circle {
    border-radius: 3rem;
    width: 3rem;
    border-radius: 50%;
    text-align: center;

}
#paper-plane {
    position: static;
    margin-left: auto;
}
#angle-down {
    position: static;
    margin-left: auto;
}

</style>