<template>
    <div id="topnav">
        <nav>
            <span id="span">
                <slot />
            </span>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'Navigation',
}
</script>
<style>
#span {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

#topnav {
  overflow: hidden;
  background-color: #333;
  z-index: 999;
  
  margin: 0 auto;
}

</style>
