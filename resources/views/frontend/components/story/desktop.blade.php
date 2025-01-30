<style>
    .story-container {
        display: flex;
        overflow-x: scroll;
        padding: 10px;
        gap: 10px;
        scrollbar-width: thin;
    }

    .story-container::-webkit-scrollbar {
        height: 8px;
    }

    .story-container::-webkit-scrollbar-thumb {
        background: rgba(200, 200, 200, 0.5);
        border-radius: 10px;
    }

    .story {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid;
        padding: 2px;
        margin: 5px;
        cursor: pointer;
    }

    .story img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .story .username {
        color: white;
        font-size: 12px;
        text-align: center;
        margin-top: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 80px;
    }

    .story-modal {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .story-modal img {
        width: 100%;
        height: 100%;
        max-height: 90%;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    #modalImage {
        width: 90%;
        height: 90%;

    }

    .progress-bar-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background-color: rgba(255, 255, 255, 0.5);
    }

    .progress-bar {
        height: 100%;
        background-color: #ff3366;
        animation: progress 30s linear forwards;
    }

    @keyframes progress {
        from {
            width: 0%;
        }

        to {
            width: 100%;
        }
    }
</style>

<div class="p-4 mx-4 mb-4 bg-white shadow rounded-4 brands-list home-minus">
    <div class="d-flex align-center justify-content-between">
        <h3 class="mb-3 fw-bold">Top stories for you</h3> 
    </div>
   
    <div class=" desktop-story">
        <!-- 1st slider -->
        <div class="item pe-3">
            <div class="story story-border" onclick="openStory(this)">
                <img alt="Profile picture of khushbu_r..."
                    src="https://storage.googleapis.com/a1aa/image/E3wTSM8qdQzoSDm4vKnDgPwCkiZDIp_CJIQ0y_gi74g.jpg" />
                <div class="username">khushbu_r...</div>
            </div>
        </div>
        <!-- 2nd -->
        <div class="item pe-3">
            <div class="story story-border" onclick="openStory(this)">
                <img alt="Profile picture of pinkiy_0911"
                    src="https://storage.googleapis.com/a1aa/image/Otcwetymqvu8chkYlyTcvGavc7qqYSxbRzp5kjbviuM.jpg" />
                <div class="username">pinkiy_0911</div>
            </div>
        </div>
        <!-- 3rd -->
        <div class="item pe-3">
            <div class="story story-border" onclick="openStory(this)">
                <img alt="Profile picture of jatt_love_60"
                    src="https://storage.googleapis.com/a1aa/image/e9LYmCTXKC2khjyydKZAV4JyS9_yGJsW9MnlmPUPX7w.jpg" />
                <div class="username">jatt_love_60</div>
            </div>
        </div>
        <!-- 4rth -->
        <div class="item pe-3">
            <div class="story story-border" onclick="openStory(this)">
                <img alt="Profile picture of up13_aala_..."
                    src="https://storage.googleapis.com/a1aa/image/Yr4uREEQqbpLI9WTxvMl-w85xaPe-As3cz3CslfQFa0.jpg" />
                <div class="username">up13_aala_...</div>
            </div>
        </div>
        <!-- 5th -->
        <div class="item pe-3">
            <div class="story story-border" onclick="openStory(this)">
                <img alt="Profile picture of khushbu_r..."
                    src="https://storage.googleapis.com/a1aa/image/E3wTSM8qdQzoSDm4vKnDgPwCkiZDIp_CJIQ0y_gi74g.jpg" />
                <div class="username">khushbu_r...</div>
            </div>
        </div>
        <!-- 6th -->
        <div class="item pe-3">
            <div class="story story-border" onclick="openStory(this)">
                <img alt="Profile picture of nitinkumar..."
                    src="https://storage.googleapis.com/a1aa/image/pRbxazoPaBtkWy4IfWo8w2W_HxWFacoyuWBWy9huHHU.jpg" />
                <div class="username">nitinkumar...</div>
            </div>
        </div>
        <div class="item pe-3">
            <div class="story story-border" onclick="openStory(this)">
                <img alt="Profile picture of riyajudin07..."
                    src="https://storage.googleapis.com/a1aa/image/MBeHnxyonc3FO0YTw-pKBPfSxc6V7SAlViyWenhJ8gM.jpg" />
                <div class="username">riyajudin07...</div>
            </div>
        </div>
        <div class="item pe-3">
            <div class="story story-border" onclick="openStory(this)">
                <img alt="Profile picture of hakim_k28..."
                    src="https://storage.googleapis.com/a1aa/image/xjnR4wuZ3QD8yMSX0PFygeSOYlyrLj66y5Q1gG2xS_8.jpg" />
                <div class="username">hakim_k28...</div>
            </div>
        </div>
     </div>
    
   
</div>

<div class="px-4">
    <div class="row g-2">
       <div class="col-4">
          <div class="text-white text-decoration-none">
             <div class="p-3 text-white rounded-md bg-danger bg-gradient">
                <h5 class="mb-1 fw-bold">Deals of the Day</h5>
                <p class="m-0 small text-white-50">60% OFF&nbsp;
                   <a href="#" class="text-decoration-none text-white-50"><i class="fa-solid fa-arrow-right"></i></a>
                </p>
             </div>
          </div>
       </div>
       <div class="col-4">
          <div class="text-white text-decoration-none">
             <div class="p-3 text-white rounded-md bg-warning bg-gradient">
                <h5 class="mb-1 fw-bold">Unlimited Flat Deal</h5>
                <p class="m-0 small text-white-50">Big orders&nbsp;
                   <a href="#" class="text-decoration-none text-white-50"><i class="fa-solid fa-arrow-right"></i></a>
                </p>
             </div>
          </div>
       </div>
       <div class="col-4">
          <div class="text-white text-decoration-none">
             <div class="p-3 text-white rounded-md bg-success bg-gradient">
                <h5 class="mb-1 fw-bold">Fastest Deliveries</h5>
                <p class="m-0 small text-white-50">See offers&nbsp;
                   <a href="#" class="text-decoration-none text-white-50"><i class="fa-solid fa-arrow-right"></i></a>
                </p>
             </div>
          </div>
       </div>
    </div>
 </div>
 

<div class="modal fade" id="storyModal" tabindex="-1" aria-labelledby="storyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="progress-bar-container">
                <div class="progress-bar"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="storyModalLabel">Story</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" class="story-modal" src="" alt="Story image">
            </div>
        </div>
    </div>
</div>

<script>
    function openStory(element) {
        const imageUrl = element.querySelector('img').src;
        document.getElementById('modalImage').src = imageUrl;
        const storyModal = new bootstrap.Modal(document.getElementById('storyModal'));
        storyModal.show();
        setTimeout(() => {
            storyModal.hide();
        }, 30000);
    }
</script>
