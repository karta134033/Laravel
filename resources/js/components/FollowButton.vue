<template>
    <div>
        <button class="btn btn-primary" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['user-id', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },
        data: function() {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)    // 利用內建的方法axios去打自己
                    .then(response => {
                        this.status =! this.status;   //讓按鈕可以動態改變成unfollow&follow
                    })
                    .catch(errors => {
                        if(errors.response.status == 401){  //401錯的的話，導入到登入頁面
                            window.location = '/login';
                        }
                    });
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow' ;
            }
        }
    }
</script>
