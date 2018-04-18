<div class="outerBox" committee="new">
    <div class="innerBox haveSlide">
        <div class="rightBox">
            <div class="tableCell">
                <h1 class="data" placeholder="Enter the name" name="name"></h1>
                <p name="description" placeholder="Enter the description" class="data"></p>
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
            
            <div class="member addMember">
                <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                </button></div>
                    <div class="chooseMember dropdown">
                            
                    </div>
            </div>
        </div>
    </div>
</div>