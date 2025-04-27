// Modern notification system for the new
class NotificationSystem {
  constructor() {
    this.container = document.createElement('div');
    this.container.className = 'notification-container';
    document.body.appendChild(this.container);
    
    // Add styles
    const style = document.createElement('style');
    style.textContent = `
      .notification-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 350px;
      }
      
      .notification {
        background: #fff;
        color: #333;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transform: translateX(120%);
        opacity: 0;
        transition: transform 0.4s ease, opacity 0.4s ease;
        overflow: hidden;
      }
      
      .notification.show {
        transform: translateX(0);
        opacity: 1;
      }
      
      .notification-content {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      
      .notification-icon {
        font-size: 20px;
        min-width: 24px;
        text-align: center;
      }
      
      .notification-message {
        font-size: 14px;
        font-weight: 500;
      }
      
      .notification-close {
        cursor: pointer;
        font-size: 18px;
        opacity: 0.6;
        transition: opacity 0.2s;
        margin-left: 10px;
      }
      
      .notification-close:hover {
        opacity: 1;
      }
      
      .notification-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        transform-origin: left;
      }
      
      .notification.success {
        border-left: 4px solid #4CAF50;
      }
      
      .notification.success .notification-icon {
        color: #4CAF50;
      }
      
      .notification.success .notification-progress {
        background: #4CAF50;
      }
      
      .notification.error {
        border-left: 4px solid #F44336;
      }
      
      .notification.error .notification-icon {
        color: #F44336;
      }
      
      .notification.error .notification-progress {
        background: #F44336;
      }
      
      .notification.info {
        border-left: 4px solid #2196F3;
      }
      
      .notification.info .notification-icon {
        color: #2196F3;
      }
      
      .notification.info .notification-progress {
        background: #2196F3;
      }
      
      /* Dark mode support */
      @media (prefers-color-scheme: dark) {
        .notification {
          background: #333;
          color: #fff;
        }
      }
    `;
    document.head.appendChild(style);
  }
  
  show(message, type = 'info', duration = 5000) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    
    
    let icon = '';
    switch(type) {
      case 'success':
        icon = '<i class="fa-solid fa-circle-check"></i>';
        break;
      case 'error':
        icon = '<i class="fa-solid fa-circle-xmark"></i>';
        break;
      default:
        icon = '<i class="fa-solid fa-circle-info"></i>';
    }
    
    
    const content = document.createElement('div');
    content.className = 'notification-content';
    
    const iconDiv = document.createElement('div');
    iconDiv.className = 'notification-icon';
    iconDiv.innerHTML = icon;
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'notification-message';
    messageDiv.textContent = message;
    
    content.appendChild(iconDiv);
    content.appendChild(messageDiv);
    
    const closeBtn = document.createElement('div');
    closeBtn.className = 'notification-close';
    closeBtn.innerHTML = '&times;';
    closeBtn.addEventListener('click', () => this.close(notification));
    
    const progress = document.createElement('div');
    progress.className = 'notification-progress';
    
    notification.appendChild(content);
    notification.appendChild(closeBtn);
    notification.appendChild(progress);
    
    this.container.appendChild(notification);
    
    setTimeout(() => {
      notification.classList.add('show');
    }, 10);
    
    progress.style.animation = `progress-shrink ${duration}ms linear forwards`;
    progress.style.transformOrigin = 'left';
    
    if (duration > 0) {
      notification.timeout = setTimeout(() => {
        this.close(notification);
      }, duration);
    }
    
    return notification;
  }
  
  close(notification) {
    if (notification.timeout) {
      clearTimeout(notification.timeout);
    }
    
    notification.classList.remove('show');
    
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 400);
  }
  
  success(message, duration = 5000) {
    return this.show(message, 'success', duration);
  }
  
  error(message, duration = 5000) {
    return this.show(message, 'error', duration);
  }
  
  info(message, duration = 5000) {
    return this.show(message, 'info', duration);
  }
}

const notifications = new NotificationSystem();

const style = document.createElement('style');
style.textContent = `
  @keyframes progress-shrink {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
  }
`;
document.head.appendChild(style);
