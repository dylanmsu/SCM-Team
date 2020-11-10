<template>
    <div style="display: inline" :style="this.icons[this.mydata].color">
        {{this.icons[this.mydata].icon}}
    </div>
</template>

<script>
export default {
    props: ['icon_index'],
    data() {
        return {
            mydata: this.icon_index,
            icons: [
                { icon: '[blank]', color: '', index: 0 },
                { icon: 'IC', color: '', index: 1 },
                { icon: 'IR', color: '', index: 2 },
                { icon: 'L', color: '', index: 3 },
                { icon: 'P', color: '', index: 4 },
                { icon: 'EXT', color: '', index: 5 },
                { icon: 'INT', color: 'color: red', index: 6 },
                { icon: 'T', color: '', index: 7 },
                { icon: 'STOOM', color: '', index: 8 },
                { icon: 'DIESEL', color: '', index: 9 },
                { icon: 'MOTORWAGEN', color: '', index: 10 },
                { icon: 'GROEP', color: '', index: 11 },
                { icon: 'SINT', color: 'color: red', index: 12 },
                { icon: 'EVENT', color: '', index: 13 },
                { icon: 'DINING', color: '', index: 14 },
                { icon: 'DIENST', color: 'color: red', index: 15 },
            ],
        }
    }
}
</script>