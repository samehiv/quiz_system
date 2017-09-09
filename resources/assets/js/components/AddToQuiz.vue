<template>
    <div class="q-options-btns">
        <button class="btn btn-primary btn-sm" @click="addQuestion" v-if="showBtn">
            Add to Quiz
        </button>
    </div>
</template>
<script>
    import swal from 'sweetalert';
    export default{
        data(){
            return {
                showBtn: true
            }
        },
        props:['quizId','questionId'],
        methods:{
            addQuestion(){
                axios.post('/quizzes/'+this.quizId+'/questions',{'id':this.questionId})
                    .then(()=>{
                        this.showBtn = false;
                        swal('Question Added','','success');
                    })
            }
        }

    }
</script>