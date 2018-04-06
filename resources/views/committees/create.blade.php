<div class="outerBox">
    <div class="innerBox haveSlide">
        <div class="leftBox">
            <div class="tableCell">
                <h1 placeholder="Enter the name" class="data" name="name"></h1>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h1>Description</h1>
                <p placeholder="Enter the description" name="description" class="data"></p>
                <div class="inputContainer Button">
                    <button class="edit">Save</button>
                    <button class="cancel">Cancel</button> 
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo')
            </div>
        </div>
    </div>
    <div class="innerBox members" style="display:block">
        <div class="flexBox">
            
            <div class="member">
                <div class="inputContainer Button addMember"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                </button></div>
            </div>
        </div>
    </div>
</div>