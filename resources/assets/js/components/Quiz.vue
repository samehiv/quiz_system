<template>
    <div>
        <div class="time-bar">
            {{timer}}
        </div>
        <div class="container" style="padding-top: 30px">
            <div class="row margin-bottom">
                <div class="col-md-8 col-md-offset-2">
                    <h3>{{quiz.name}}</h3>
                </div>
            </div>
            <form method="POST" :action="'/quizzes/'+quiz.id+'/results'">
                <input type="hidden" name="_token" :value="token()">
                <div class="row" v-for="(question,index) in questions">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">Question #{{index+1}}</div>
                            <div class="panel-body">
                                <p>{{getQuestion(question)}}</p>
                                <pre v-if="getCode(question) !== null">
                                <code>{{getCode(question)}}</code>
                            </pre>
                                <div class="radio" v-for="answer in question.answers">
                                    <label>
                                        <input type="radio" :name="question.id" :value="answer.id">{{answer.answer}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <button class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</template>
<script>
    const moment = require('moment');
    export default {
        mounted(){
            this.addScrollListener();
            this.questions = JSON.parse(this.jQuestions);
            this.quiz = JSON.parse(this.jQuiz);
            this.countdown();
        },
        data(){
            return {
                questions: [],
                quiz: {},
                timer: '',
            }
        },
        props:['jQuestions','jQuiz'],
        methods:{
            getQuestion(question){
                return JSON.parse(question.question).question;
            },
            getCode(question){
                return JSON.parse(question.question).code;
            },
            countdown(){
                let o = this;
                let time = this.quiz.time*60*1000;
                let duration = moment.duration(time);
                this.timer = duration.minutes()+' : '+duration.seconds();
                let interval = setInterval(function(){
                    time = time - 1000;
                    duration = moment.duration(duration - 1000);
                    o.timer = duration.minutes()+' : '+duration.seconds();
                    if(time === 0){
                        clearInterval(interval);
                        console.log('fasdfa');
                        $('form').submit();
                    }
                },1000);

            },
            addScrollListener(){
                $(window).scroll(function() {
                    if($(window).scrollTop() >= 50){
                        $('.time-bar').addClass('fixed')
                    }else{
                        $('.time-bar').removeClass('fixed')
                    }
                });
            },
            token(){
                return document.head.querySelector('meta[name="csrf-token"]').content;
            }
        }
    }
</script>