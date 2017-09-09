<template>
    <div>
        <div class="row" v-for="(question,index) in questions">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="q-options-btns">
                            <a :href="'/questions/'+question.id+'/edit'" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                            <button class="btn btn-danger btn-sm" @click="confirm(question,index)">
                                Remove from Quiz
                            </button>
                        </div>
                        <p>{{getQuestion(question)}}</p>
                        <h4>The Answer is: {{question.answer}}</h4>
                        Points: {{question.points}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        mounted(){
            this.questions = JSON.parse(this.jQuestions);
        },
        data(){
            return {
                questions: [],
                body: {}
            }
        },
        props:['quizId','jQuestions'],
        methods:{
            confirm(question,index){
                swal({
                    title: "Are you sure?",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: "Yes Remove this question"
                    },
                    dangerMode: true,
                }).then(() => {
                    this.removeFromQuiz(question,index);
                });
            },
            removeFromQuiz(question,index){
                axios.delete('/quizzes/'+this.quizId+'/questions/'+question.id)
                    .then(()=>{
                        this.questions = this.questions.slice(0,index)
                            .concat(this.questions.slice(index+1, this.questions.length));
                    });
            },
            getQuestion(question){
                return JSON.parse(question.question).question;
            }
        }
    }
</script>