<?php
/**
 * Lanfoster Shortcuts for WP
 *
 * @package lanfoster
 * @subpackage lanfosterWP
 */

/*

*/

final class lanfosterWP_front {

	public $version = '0.1';
	
	public function pagination() {
		global $wp_query;

		wp_enqueue_style( 'lanfoster-pagination', lanfosterWP()->cssPATH.'pagination.css' );

		$maxPage = intval($wp_query->max_num_pages);
		$curPage = intval(get_query_var('paged'));
		if( $curPage == 0 ) $curPage =1;
		$delta = 1;

		
		if( $maxPage > 1 ) {
			echo '<ul class="pagination">';
			if( $curPage > 1 ) echo '<li class="page active"><a href="'.esc_url(get_pagenum_link($curPage-1)).'" />Précédents</a></li>';
			$this->writePage(1, $curPage);
			if( $maxPage < 4 ) {
				for ($i = 2; $i <= $maxPage; $i++) {
					$this->writePage($i, $curPage);
				}
			} else {
				if( $curPage > $delta +2 ) $this->writeEllipsis();
				for ($i = $curPage - $delta; $i <= min($curPage + $delta, $maxPage); $i++) {
					if( $i > 1 && $i < $maxPage) $this->writePage($i, $curPage);
				}
				if( $curPage < $maxPage - $delta -1 ) {
					$this->writeEllipsis();
				}
				$this->writePage($maxPage, $curPage);
				
			}
			if( $curPage < $maxPage ) echo '<li class="page active"><a href="'.esc_url(get_pagenum_link($curPage+1)).'" />Suivants</a></li>';

			echo "</ul>";
		}
	}

	protected function writeEllipsis() {
		echo '<li class="page elipsis">...</li>';
	}

	protected function writePage($index, $curPage){
		if( intval($index) == intval($curPage)) {
			echo '<li class="page current">'.$index.'</li>';
		} else {
			echo '<li class="page active"><a href="'.esc_url(get_pagenum_link($index)).'" />'.$index.'</a></li>';
		}	
	}

}

