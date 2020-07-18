<template>
    <div id="page">
        <form v-on:submit.prevent="send">
            <h1 id="weergave">Weergave Borden</h1>
            <div id="board" class="basic-card">
                <div class="container board">
                    <input type="radio" id="radio1" name="radios-board" value="a" v-model="result.board">
                    <label for="radio1">Bord A</label>
                    <input type="radio" id="radio2" name="radios-board" value="b" v-model="result.board">
                    <label for="radio2">Bord B</label>
                </div>
                <div>
                    <p>tekst layout</p>
                    <div class="container text-align">
                        <input type="radio" name="alignText" id="left" value="left" v-model="result.align">
                        <label for="left">links</label>
                        <input type="radio" name="alignText" id="center" value="center" v-model="result.align">
                        <label for="center">center</label>
                        <input type="radio" name="alignText" id="right" value="right" v-model="result.align">
                        <label for="right">rechts</label>
                    </div>
                </div>
                <div>
                    <p>tekst</p>
                    <div>
                        <input :class="result.align" class="basic-inputstyle" type="text" maxlength="14" spellcheck="false" autocapitalize="off" v-model="result.first_text">
                        <input :class="result.align" class="basic-inputstyle" type="text" maxlength="14" spellcheck="false" autocapitalize="off" v-model="result.second_text">
                    </div>
                </div>
                <div>
                    <p>icoon</p>
                    <div>
                        <select class="basic-inputstyle" v-model="result.icon_index">
                            <option value="0">[blank]</option>
                            <option value="1">IC</option>
                            <option value="2">IR</option>
                            <option value="3">L</option>
                            <option value="4">P</option>
                            <option value="5">EXP</option>
                            <option value="6" style="color: red">IR</option>
                            <option value="7" style="color: red">IT</option>
                            <option value="8" style="color: red">?</option>
                            <option value="9" style="color: red">INT</option>
                            <option value="10">T</option>
                            <option value="11">STOOM</option>
                            <option value="12">MW</option>
                            <option value="13">KRUIS</option>
                            <option value="14">ORIENT</option>
                            <option value="15" style="color: red">DIENST</option>
                        </select>
                    </div>
                </div>
                <div>
                    <p>datum</p>
                    <div>
                        <input required class="basic-inputstyle" type="datetime-local" maxlength="14" v-model="result.time">
                    </div>
                </div>
                <div>
                    <div>
                        <input class="basic-inputstyle" type="submit">{{responseText}}
                    </div>
                </div>
            </div>
        </form>
        <div id="container-prev">
            <h1>Voorbeeld</h1>
            <board-preview class="basic-card" v-bind:splitflapData="result"/>
        </div>
    </div>
</template>

<script>
//import Preview from './components/SplitflapPreview.vue';
import axios from 'axios';

export default {
    name: 'weergave',
    data() {
        return {
            disableSubmit: false,
            responseText: '',
            result: {
                board: 'a',
                align: 'left',
                first_text: "",
                second_text: "",
                icon_index: "0",
                time: "  -  -  T  :  "
            }
        }
    },
    methods: {
        async send() {
                let response = await axios.post('auth/splitflap',this.result)
                console.log(response)
        }
    }
}
</script>

<style scoped>
#container-prev {
    display: block;
    margin: 0 auto;
    width: 80%;
}

#page {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
}

#board {
    grid-column: 1;
    width: 80%; 
}

input[type=text] {
    width: 100%;
    box-sizing: border-box;
    font-size: 2em;
    padding: 5px;
    padding-bottom: 7px;
    margin: 5px 0;
}

p {
    text-align: left;
    margin-bottom: 2px;
}

@media only screen and (max-width: 1000px){
    #page {
        grid-template-columns: repeat(1, 1fr);
    }

    #board {
        grid-column: 1;
        width: 80%;
    }
}

.container {
    display: flex;
    margin-bottom: 30px;
}

.container > * {
    flex: 1;
}

input[type=datetime-local]{
    width: 100%;
    font-size: 1.5em;
    padding: 4px;
    padding-bottom: 6px;
    box-sizing: border-box;
}

input[type=submit], button {
    width: 30%;
    height: 40px;
    margin: 20px 10px 10px 10px;
    font-weight: bold;
}

input[type=submit]:hover, button:hover {
    background-color: lightgreen;
}

select {
    width: 100%;
    font-size: 2em;
    padding: 4px;
    padding-bottom: 6px;
}

select > option {
    font-weight: bold;
}

.left {text-align: left;}
.center {text-align: center;}
.right {text-align: right;}
</style>