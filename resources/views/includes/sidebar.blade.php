<div class="sidebar">
    <ul class="sidebar-list">
      <li class="sidebar-list-item">
        <a href="/dashboard">
          <i style="margin-right: 10px; cursor: pointer;" class="fa-solid fa-house"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="sidebar-list-item">
        <a href="/familie">
          <i style="margin-right: 10px; cursor: pointer;" class="fa-solid fa-user"></i>
          <span>Families</span>
        </a>
      </li>
    </ul>
    <div class="account-info">
      <div class="account-info-picture">
        <img src="https://images.unsplash.com/photo-1527736947477-2790e28f3443?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTE2fHx3b21hbnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" alt="Account">
      </div>
      <div class="account-info-name">{{ $data['user']->name }}</div>
      <button class="account-info-more">
        <i style="margin-right: 10px; cursor: pointer;" class="fa-solid fa-arrow-right-from-bracket"></i>
      </button>
  </div>
</div>