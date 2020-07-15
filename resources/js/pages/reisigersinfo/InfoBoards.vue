<template>
    <div>
        <div id="page">
            <div id="prevA">
                <p>bord A</p>
                <preview class="basic-card" v-bind:splitflapData="boardA"/>
            </div>
            <div id="prevB">
                <p>bord B</p>
                <preview class="basic-card" v-bind:splitflapData="boardB"/>
            </div>
            <table id="list" class="basic-card">
                <tr>
                    <th class="board">board</th>
                    <th class="first-text">first text</th>
                    <th class="second-text">second text</th>
                    <th class="icon">icon</th>
                    <th class="date">date</th>
                </tr>
                <tr v-for="item in data" v-bind:key="item.id">
                    <td>{{item.board}}</td>
                    <td>{{item.first_text}}</td>
                    <td>{{item.second_text}}</td>
                    <td>{{item.icon_index}}</td>
                    <td>{{item.time}}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import Preview from '@/components/SplitflapPreview.vue';
import axios from 'axios';

export default {
    components: {
        'preview': Preview
    },
    data() {
        return {
            data: '',
            boardA: {
                board: 'a',
                align: 'left',
                first_text: "",
                second_text: "",
                icon_index: "0",
                time: "  -  -  T  :  "
            },
            boardB: {
                board: 'a',
                align: 'left',
                first_text: "",
                second_text: "",
                icon_index: "0",
                time: "  -  -  T  :  "
            }
        }
    },
    created() {
        this.update()
    },
    methods: {
        async update() {
            let response = await axios.get('auth/splitflap');
            let data = response.data;
            this.data = data;

            let boardresponse = await axios.get('open/current-boards');
            let boardA = boardresponse.data.A[0]
            let boardB = boardresponse.data.B[0]
            this.boardA.time = boardA.time
            this.boardB.time = boardB.time
            this.boardA.align = boardA.align
            this.boardB.align = boardB.align
            this.boardA.icon_index = boardA.icon_index
            this.boardB.icon_index = boardB.icon_index
            this.boardA.first_text = boardA.first_text
            this.boardB.first_text = boardB.first_text
            this.boardA.second_text = boardA.second_text
            this.boardB.second_text = boardB.second_text
        }
    }
}
</script>

<style scoped>

#page {
    display: grid;
    grid-template-columns: 1fr 1fr;
}

#prevA {
    grid-row: 1;
    grid-column: 1;
    display: block;
    margin: 0 auto;
    width: 60%;
}

#prevB {
    grid-row: 1;
    grid-column: 2;
    display: block;
    margin: 0 auto;
    width: 60%;
}

#list {
    grid-column: 1/3;
    display: block;
    table-layout: fixed;
    margin: 0 auto;
    font-size: 1em;
    font-weight: bold;
    width: 80%;
}

th {
    border: 1px solid #ddd;
    text-align: left;
}

tr:hover {
    background-color: lightgray;
}


.board {width: calc(5vw * 0.8);}
.first-text {width: calc(30vw * 0.8);}
.second-text {width: calc(30vw * 0.8);}
.icon {width: calc(5vw * 0.8);}
.date {width: calc(30vw * 0.8);}



tr:nth-child(even) {
    background-color: lightgreen;
}

tr:nth-child(odd) {
    background-color: white;
}

@media only screen and (max-width: 1000px){
    #page {
        display: grid;
        grid-template-columns: 1fr;
    }

    #prevA {
        grid-row: 1;
        grid-column: 1;
        display: block;
        margin: 0 auto;
        width: 80%;
    }

    #prevB {
        grid-row: 2;
        grid-column: 1;
        display: block;
        margin: 0 auto;
        width: 80%;
    }

    #list {
        font-size: .7em;
    }
}
</style>