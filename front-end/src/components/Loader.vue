<template>
    <div class="loader-container">
        <div class="spinner"></div>
    </div>
</template>

<script>
export default {
    /* eslint-disable */

    name: 'Loader'
};
</script>

<style scoped>
.loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.5);
    /* Cor de fundo desfocada */
    backdrop-filter: blur(5px);
    /* Desfoque do fundo */
}

.spinner {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 4px solid #ccc;
    border-top-color: #007bff;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>