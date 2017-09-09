<template>
    <form method="POST" @submit.prevent="submit">
        <div class="form-group" :class="{'has-error':errors.hasOwnProperty('question')}">
            <label for="question">Question:</label>
            <textarea id="question" class="form-control" name="question" required></textarea>
            <span class="help-block" v-if="errors.hasOwnProperty('question')">
                {{errors.question[0]}}
            </span>
        </div>
        <div class="form-group" :class="{'has-error':errors.hasOwnProperty('points')}">
            <label for="points">Points:</label>
            <input class="form-control" name="points" id="points" required>
            <span class="help-block" v-if="errors.hasOwnProperty('points')">
                {{errors.points[0]}}
            </span>
        </div>
        <div class="form-group">
            <label for="cat">Category:</label>
            <select class="form-control" id="cat" name="category_id">
                <option value="1">PHP</option>
                <option value="2">Java SE</option>
                <option value="3">MySQL</option>
                <option value="4">Python</option>
            </select>
        </div>
        <div class="form-group">
            <label for="code">Code:</label>
            <textarea class="form-control" id="code" name="code" rows="6"></textarea>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select class="form-control" id="type" v-model="type" name="type_id" @change="changeTypeListener">
                <option value="1">True/False</option>
                <option value="2">Choices</option>
            </select>
        </div>
        <div class="form-group" v-if="type == '1'" :class="{'has-error':answersHaveError() || errors.hasOwnProperty('correct')}">
            <label>Answers:</label>
            <div class="q-option">
                <input class="form-control" value="true" name="answers[]" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="1" v-model="correctAnswer"> correct</label>
                </div>
            </div>
            <div class="q-option">
                <input class="form-control" value="false" name="answers[]" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="2" v-model="correctAnswer"> correct</label>
                </div>
            </div>
            <span class="help-block" v-if="answersHaveError() || errors.hasOwnProperty('correct')">
                Invalid answers Values
            </span>
        </div>
        <div class="form-group" :class="{'has-error':answersHaveError() || errors.hasOwnProperty('correct')}" v-else>
            <label>Answers:</label>
            <div class="q-option">
                <input class="form-control" name="answers[]" placeholder="option 1" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="1" v-model="correctAnswer"> correct</label>
                </div>
            </div>
            <div class="q-option">
                <input class="form-control" name="answers[]" placeholder="option 2" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="2" v-model="correctAnswer"> correct</label>
                </div>
            </div>
            <div class="q-option">
                <input class="form-control" name="answers[]" placeholder="option 3" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="3" v-model="correctAnswer"> correct</label>
                </div>
            </div>
            <div class="q-option">
                <input class="form-control" name="answers[]" placeholder="option 4" required>
                <div class="radio">
                    <label><input type="radio" name="correct" value="4" v-model="correctAnswer"> correct</label>
                </div>
            </div>
            <span class="help-block" v-if="answersHaveError() || errors.hasOwnProperty('correct')">
                Invalid answers Values
            </span>
        </div>
        <button class="btn btn-primary">Create</button>
    </form>
</template>
<script>
    export default{
        data(){
            return {
                type: '1',
                correctAnswer: '1',
                errors:{},
            }
        },
        methods:{
            submit(e){
                this.errors = {};
                let data = new FormData(e.target);
                axios.post('/questions',data)
                    .then(response=>{
                        window.location = '/questions';
                    }).catch(err=>{
                        this.errors = err.response.data.errors;
                    })
            },
            answersHaveError(){
                if(this.errors.hasOwnProperty('answers.0')){
                    return true;
                }
                if(this.errors.hasOwnProperty('answers.1')){
                    return true;
                }
                if(this.errors.hasOwnProperty('answers.2')){
                    return true;
                }
                if(this.errors.hasOwnProperty('answers.3')){
                    return true;
                }
                return false;

            },
            changeTypeListener(){
                this.correctAnswer = '1';
            }
        }
    }
</script>