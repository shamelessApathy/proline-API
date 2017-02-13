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