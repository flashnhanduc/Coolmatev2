import { useEffect, useState } from 'react';
import styles from './StorySection.module.css';

const stories = [
    {
        id: 1,
        title: 'Đồ mặc hằng ngày',
        image: '/images/stories/story-1.jpg',
    },
    {
        id: 2,
        title: 'Đồ thể thao',
        image: '/images/stories/story-2.jpg',
    },
    {
        id: 3,
        title: 'Sản phẩm mới',
        image: '/images/stories/story-3.jpg',
    },
    {
        id: 4,
        title:'Sản phẩm mới',
        image:'/images/stories/story-4.jpg'
    }

];

function StorySection() {
    /*
     * null nghĩa là modal đang đóng.
     * 0, 1, 2... là vị trí Story đang được xem.
     */
    const [selectedIndex, setSelectedIndex] = useState(null);

    const isOpen = selectedIndex !== null;

    function openStory(index) {
        setSelectedIndex(index);
    }

    function closeStory() {
        setSelectedIndex(null);
    }

    function nextStory() {
        setSelectedIndex((currentIndex) => {
            return (currentIndex + 1) % stories.length;
        });
    }

    function previousStory() {
        setSelectedIndex((currentIndex) => {
            return (
                currentIndex - 1 + stories.length
            ) % stories.length;
        });
    }

    /*
     * Khi Story mở:
     * - Khóa cuộn trang.
     * - Cho phép sử dụng phím Esc, trái và phải.
     */
    useEffect(() => {
        if (!isOpen) {
            return;
        }

        const previousOverflow =
            document.body.style.overflow;

        document.body.style.overflow = 'hidden';

        function handleKeyDown(event) {
            if (event.key === 'Escape') {
                closeStory();
            }

            if (event.key === 'ArrowRight') {
                nextStory();
            }

            if (event.key === 'ArrowLeft') {
                previousStory();
            }
        }

        window.addEventListener('keydown', handleKeyDown);

        return () => {
            document.body.style.overflow =
                previousOverflow;

            window.removeEventListener(
                'keydown',
                handleKeyDown
            );
        };
    }, [isOpen]);

    // Tự chuyển Story sau mỗi 5 giây
    useEffect(() => {
        if (!isOpen) {
            return;
        }

        const intervalId = setInterval(() => {
            nextStory();
        }, 5000);

        return () => clearInterval(intervalId);
    }, [isOpen]);

    let previousIndex = 0;
    let nextIndex = 0;

    if (selectedIndex !== null) {
        previousIndex =
            (selectedIndex - 1 + stories.length) %
            stories.length;

        nextIndex =
            (selectedIndex + 1) % stories.length;
    }

    return (
        <section
            className={styles.storySection}
            aria-label="Coolmate Story"
        >
            <div className={styles.storyList}>
                {stories.map((story, index) => (
                    <button
                        key={story.id}
                        type="button"
                        className={styles.storyButton}
                        onClick={() => openStory(index)}
                        aria-label={`Xem Story ${story.title}`}
                    >
                        <span className={styles.storyRing}>
                            <img
                                className={styles.thumbnail}
                                src={story.image}
                                alt={story.title}
                            />
                        </span>

                        <span className={styles.storyTitle}>
                            {story.title}
                        </span>
                    </button>
                ))}
            </div>

            {isOpen && (
                <div
                    className={styles.modal}
                    role="dialog"
                    aria-modal="true"
                    aria-label="Trình xem Story"
                    onClick={closeStory}
                >
                    <button
                        type="button"
                        className={styles.closeButton}
                        onClick={closeStory}
                        aria-label="Đóng Story"
                    >
                        ×
                    </button>

                    <button
                        type="button"
                        className={`${styles.navigationButton} ${styles.previousButton}`}
                        onClick={(event) => {
                            event.stopPropagation();
                            previousStory();
                        }}
                        aria-label="Story trước"
                    >
                        &#10094;
                    </button>

                    <div
                        className={styles.storyViewer}
                        onClick={(event) =>
                            event.stopPropagation()
                        }
                    >
                        <button
                            type="button"
                            className={styles.sideStory}
                            onClick={previousStory}
                            aria-label="Xem Story trước"
                        >
                            <img
                                src={
                                    stories[previousIndex]
                                        .image
                                }
                                alt=""
                            />
                        </button>

                        <article
                            key={selectedIndex}
                            className={styles.activeStory}
                        >
                            <div
                                className={
                                    styles.progressList
                                }
                            >
                                {stories.map(
                                    (story, index) => (
                                        <span
                                            key={story.id}
                                            className={`${
                                                styles.progress
                                            } ${
                                                index <
                                                selectedIndex
                                                    ? styles.completedProgress
                                                    : ''
                                            } ${
                                                index ===
                                                selectedIndex
                                                    ? styles.activeProgress
                                                    : ''
                                            }`}
                                        />
                                    )
                                )}
                            </div>

                            <div
                                className={styles.storyHeader}
                            >
                                <span
                                    className={
                                        styles.smallAvatar
                                    }
                                >
                                    <img
                                        src={
                                            stories[
                                                selectedIndex
                                            ].image
                                        }
                                        alt=""
                                    />
                                </span>

                                <strong>Coolmate</strong>

                                <span>
                                    {selectedIndex + 1}/
                                    {stories.length}
                                </span>
                            </div>

                            <img
                                className={styles.storyImage}
                                src={
                                    stories[selectedIndex]
                                        .image
                                }
                                alt={
                                    stories[selectedIndex]
                                        .title
                                }
                            />
                        </article>

                        <button
                            type="button"
                            className={styles.sideStory}
                            onClick={nextStory}
                            aria-label="Xem Story tiếp theo"
                        >
                            <img
                                src={stories[nextIndex].image}
                                alt=""
                            />
                        </button>
                    </div>

                    <button
                        type="button"
                        className={`${styles.navigationButton} ${styles.nextButton}`}
                        onClick={(event) => {
                            event.stopPropagation();
                            nextStory();
                        }}
                        aria-label="Story tiếp theo"
                    >
                        &#10095;
                    </button>
                </div>
            )}
        </section>
    );
}

export default StorySection;