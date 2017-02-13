<template>
<div class='container'>
<h1>add</h1>	
<div class='row'>

<label>SKU</label><br>
<input type='text' name='sku'><br>

<label>Category</label><br>
<select name='category'>
	<option value='1'>Wall</option>
	<option value='2'>Under Cabinet</option>
	<option value='3'>Outdoor</option>
	<option value='6'>Professional</option>
	<option value='4'>Island</option>
	<option value='7'>Artisan</option>
	<option value='5'>Inserts</option>
	<option value='8'>Accessories</option>
</select>

<label>Amount</label><br>
<input type='number' name='inventory'><br>

<label>Product Name</label><br>
<input type='text' name='name'><br>

<label>Default Image</label><br>
<input type='text' :path='src' name='image_path' v-model="previewSrc"><br>

<label>Spec Sheet</label><br>
<input type='text' name='spec_sheet_path'><br><br>

<label>Optional Attributes</label>&nbsp&nbsp<input type='checkbox' name='optional_attributes'><br>

<button type='submit'>Add Product</button>

</div>

    <div class="image_preview">
    	<img :src='previewSrc' v-if='previewSrc'/>
        <div style='width:200px; height:200px; background-color:blue;'></div>
    </div>
</div>
</template>

<script>
    export default {
    	props: {
        		id: String,
        		name: String,
        		src: String
        	},
        data: function(){
        	return {previewSrc: "http://prolinerangehoods.com/" +this.previewSrc }
        	 	},
        	mounted() {
        		this.src = previewSrc;
        	}
        
    }
</script>