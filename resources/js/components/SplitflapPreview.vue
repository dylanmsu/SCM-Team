<template>
    <div id="preview">
        <div class="preview-char" id="character" v-for="i in items" :key="i.id" :style="i.color">
            {{i.char}}
        </div>
        <div class="preview-char" id="icon" :style="icons[result.icon_index].color">
            {{icons[result.icon_index].icon}} 
        </div>
        <div id="gap">
        </div>
        <div class="preview-char" id="hours" style="color: white">
            {{hours}}
        </div>
        <div class="preview-char" id="minutes" style="color: white">
            {{minsA}}
        </div>
        <div class="preview-char" id="minutes" style="color: white">
            {{minsB}}
        </div>
    </div>
</template>

<script>
export default {
    props: ['splitflapdata'],
    name: 'app',
    data() {
        return {
            data: JSON.parse(this.splitflapdata),
            hours: '',
            minsA: '',
            minsB: '',
            items: [
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
                { char: ' ', color: 'color: white' },
            ],
            icons: [
                { icon: ' ', color: 'color: white', index: 0 },
                { icon: 'ic', color: 'color: white', index: 1 },
                { icon: 'IR', color: 'color: white', index: 2 },
                { icon: 'L', color: 'color: white', index: 3 },
                { icon: 'P', color: 'color: white', index: 4 },
                { icon: 'EXP', color: 'color: white', index: 5 },
                { icon: 'IR', color: 'color: red', index: 6 },
                { icon: 'IT', color: 'color: red', index: 7 },
                { icon: '?', color: 'color: red', index: 8 },
                { icon: 'INT', color: 'color: red', index: 9 },
                { icon: 'T', color: 'color: white', index: 10 },
                { icon: 'STOOM', color: 'color: white', index: 11 },
                { icon: 'MV', color: 'color: white', index: 12 },
                { icon: 'KRUIS', color: 'color: white', index: 13 },
                { icon: 'ORIENT', color: 'color: white', index: 14 },
                { icon: 'DIENST', color: 'color: red', index: 15 },
            ],
            result: {}
        }
    },
    methods: {
        splitAndDraw(text1,text2) {

            //top row
            for(let i = 0; i <= 14; i++){

                if (!(this.items[i+14] == null)){

                    // sets the color to red if the charakter is uppercase
                    if (text1.split("")[i] == text1.toUpperCase().split("")[i]){
                        this.items[i].color = 'color: red'
                    } else {
                        this.items[i].color = 'color: white'
                    }

                    // splits string into individual charakters
                    if (text1.toUpperCase().split("")[i] == ""){
                        this.items[i].char = " "
                    } else {
                        if (!(text1 == "") && !(text1 == undefined)){
                            this.items[i].char = text1.toUpperCase().split("")[i]
                        }
                        
                    }
                }
            }

            // bottom row
            for(let i = 0; i <= 14; i++){

                if (!(this.items[i+14] == null)){

                    // sets the color to red if the charakter is uppercase
                    if (text2.split("")[i] == text2.toUpperCase().split("")[i]){
                        this.items[i+14].color = 'color: red'
                    } else {
                        this.items[i+14].color = 'color: white'
                    }

                    // splits string into individual charakters
                    if (text2.toUpperCase().split("")[i] == ""){
                        this.items[i+14].char = " "
                    } else {
                        if (!(text2 == "") && !(text2 == undefined)){
                            this.items[i+14].char = text2.toUpperCase().split("")[i]
                        }
                    }
                }
                
            }
        },
        updateText() {
            // sets all the varibles to a defailt value when its null
            if(this.data.align == null){this.result.align = "left"} else {this.result.align = this.data.align}
            if(this.data.first_text == null){this.result.first_text = ""} else {this.result.first_text = this.data.first_text}
            if(this.data.second_text == null){this.result.second_text = ""} else {this.result.second_text = this.data.second_text}
            if(this.data.icon_index == null){this.result.icon_index = "0"} else {this.result.icon_index = this.data.icon_index}
            if(this.data.time == null){this.result.time = ""} else {this.result.time = this.data.time}
            
            let date = new Date(this.result.time);
            let minutes = ""

            // makes sure we dont get 'nan' on the splitflap boards
            if (date.getHours().toString() == "NaN"){
                this.hours = " "
            } else {
                this.hours = date.getHours().toString() + "."
            }

            // makes sure we dont get 'nan' on the splitflap boards
            if (date.getMinutes().toString() == "NaN"){
                minutes = "  "
            } else {
                minutes = date.getMinutes().toString()
            }
            
            // get indigidual digits of the minutes
            if (minutes.length == 1){
                this.minsA = '0'
                this.minsB = minutes
            } else {
                this.minsA = minutes.split("")[0]
                this.minsB = minutes.split("")[1]
            }
            
            // align text left
            if (this.data.align == "left")
            {
                let a = this.result.first_text + this.space(14 - this.result.first_text.length - 1)
                let b = this.result.second_text + this.space(14 - this.result.second_text.length - 1)
                this.splitAndDraw(a,b)
            } 
            // align text center
            else if (this.data.align == "center")
            {
                let spaceA = this.space((14 - this.result.first_text.length)/2-1)
                let spaceB = this.space((14 - this.result.second_text.length)/2-1)
                let a = spaceA + this.result.first_text + this.space(14-(spaceA.length+this.result.first_text.length))
                let b = spaceB + this.result.second_text + this.space(14-(spaceB.length+this.result.second_text.length))
                this.splitAndDraw(a,b)
            }
            // align text right
            else if (this.data.align == "right")
            {
                let a = this.space(14 - this.result.first_text.length - 1) + this.result.first_text
                let b = this.space(14 - this.result.second_text.length - 1) + this.result.second_text
                this.splitAndDraw(a,b)
            }
        },
        //create a string with a certain number of spaces 
        space(amount) {
            let spaceStr = ""
            for(let i = 0; i <= amount; i++){
                spaceStr += " "
            }
            return spaceStr
        }
    },
    created() {
        //update every 500ms
        setInterval(() => {
            this.updateText();
        }, 500);
    }
}
</script>

<style>
/*  */
#preview {
    grid-column: 2;
    margin-bottom: 50px;
    padding: 10px;
    display: grid;
    grid-template-columns: repeat(14, 1fr);
}

/* style of the individual charakter */
.preview-char {
    background-color: #000;
    border: 2px solid #222;
    height: 3vw;
    color: white;
    font-size: 1.9vw;
    font-weight: bold;
    font-family: 'Roboto', sans-serif, monospace;
}

/* style of the icon */
#icon {
    grid-column: 1/9;
}

/* the gap between the time and icon */
#gap {
    grid-column: 9/11;
    background-color: #222;
}

/* */
#hours {
    grid-column: 11/13;
}

/* if the window is less than 1000px in width*/
@media (max-width: 1000px){
    .preview-char {
        height: 6.5vw;
        font-size: 3.8vw;
    }
}
</style>