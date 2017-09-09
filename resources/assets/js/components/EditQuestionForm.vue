<template>
    <form method="POST" @submit.prevent="submit">
        <div class="form-group" :class="{'has-error':errors.hasOwnProperty('question')}">
            <label for="question">Question:</label>
            <textarea id="question" class="form-control" name="question" required>{{body.question}}</textarea>
            <span class="help-block" v-if="errors.hasOwnProperty('question')">
                {{errors.question[0]}}
            </span>
        </div>
        <div class="form-group" :class="{'has-error':errors.hasOwnProperty('points')}">
            <label for="points">Points:</label>
            <input class="form-control" name="points" id="points" :value="question.points" required>
            <span class="help-block" v-if="errors.hasOwnProperty('points')">
                {{errors.points[0]}}
            </span>
        </div>
        <div class="form-group">
            <label for="cat">Category:</label>
            <select class="form-control" id="cat" name="category_id" v-model="question.category_id">
                <option value="1">PHP</option>
                <option value="2">Java SE</option>
                <option value="3">MySQL</option>
                <option value="4">Python</option>
            </select>
        </div>
        <div class="form-group">
            <label for="code">Code:</label>
            <textarea class="form-control" id="code" name="code" rows="6">{{body.code}}</textarea>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select class="form-control" id="type" v-model="type" name="type_id" @change="changeTypeListener">
                <option value="1">True/False</option>
                <option value="2">Choices</option>
            </select>
        </div>
        <div class="form-group" v-if="type == 1" :class="{'has-error':answersHaveError() || errors.hasOwnProperty('correct')}">
            <label>Answers:</label>
            <div class="q-option">
                <input class="form-control" :value="getValue(0)" name="answers[]" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="1" :checked="correctAnswer == 1"> correct</label>
                </div>
            </div>
            <div class="q-option">
                <input class="form-control" :value="getValue(1)" name="answers[]" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="2" :checked="correctAnswer == 2"> correct</label>
                </div>
            </div>
            <span class="help-block" v-if="answersHaveError() || errors.hasOwnProperty('correct')">
                Invalid answers Values
            </span>
        </div>
        <div class="form-group" :class="{'has-error':answersHaveError() || errors.hasOwnProperty('correct')}" v-else>
            <label>Answers:</label>
            <div class="q-option">
                <input class="form-control" name="answers[]" placeholder="option 1" :value="getValue(0)" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="1" :checked="correctAnswer == 1"> correct</label>
                </div>
            </div>
            <div class="q-option">
                <input class="form-control" name="answers[]" placeholder="option 2" :value="getValue(1)" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="2" :checked="correctAnswer == 2"> correct</label>
                </div>
            </div>
            <div class="q-option">
                <input class="form-control" name="answers[]" placeholder="option 3" :value="getValue(2)" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="3" :checked="correctAnswer == 3"> correct</label>
                </div>
            </div>
            <div class="q-option">
                <input class="form-control" name="answers[]" placeholder="option 4" :value="getValue(3)" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="4" :checked="correctAnswer == 4"> correct</label>
                </div>
            </div>
            <span class="help-block" v-if="answersHaveError() || errors.hasOwnProperty('correct')">
                Invalid answers Values
            </span>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</template>
<script>
    export default{
        mounted(){
            this.question = JSON.parse(this.jQuestion);
            this.body = JSON.parse(this.question.question);
            this.answers = this.question.answers;
            this.type = this.question.question_type_id;
            this.correctAnswer = this.getCorrectAnswer();
        },
        data(){
            return {
                type: 1,
                correctAnswer: '1',
                answers: [],
                body: {},
                errors:{},
                question: {}
            }
        },
        props:['jQuestion'],
        methods:{
            submit(e){
                this.errors = {};
                let data = new FormData(e.target);
                axios.post('/questions/'+this.question.id+'/update',data)
                    .then(response=>{
                        window.location = '/questions';
                    }).catch(err=>{
                    this.errors = err.response.data.errors;
                })
            },
            answersHaveError(){
                if(this.errors.hasOwnProperty('answers.1')){
                    return true;
                }
                if(this.errors.hasOwnProperty('answers.2')){
                    return true;
                }
                if(this.errors.hasOwnProperty('answers.3')){
                    return true;
                }
                if(this.errors.hasOwnProperty('answers.4')){
                    return true;
                }
                return false;

            },
            getCorrectAnswer(){
                return this.question.answers.findIndex(obj=>{
                    return obj.is_correct == true;
                })+1;
            },
            changeTypeListener(){
                this.correctAnswer = '1';
            },
            getValue(index){
                if(this.answers[index] !== undefined){
                    return this.answers[index].answer;
                }
                return null;
            }

        }
    }
</script>