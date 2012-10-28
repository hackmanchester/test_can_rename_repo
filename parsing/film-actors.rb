require 'csv'
require 'rubygems'
require 'mongo'

@actors=[]
@films={}

def actors
	@actors
end
def films
	@films
end

n=0
CSV.foreach("../data/actor.tsv",{:col_sep=>"\t", :headers=>true, :return_headers => true, :header_converters => :symbol, :converters => :all}) do |row|
	actor = Hash[row.headers[0..-1].zip(row.fields[0..-1])]
	if actor[:film]!=nil then
		actors << {:name => actor[:name] , :films => actor[:film].split(',')}
		# puts n
		n+=1
	end
end

n=0
CSV.foreach("../data/film.tsv",{:col_sep=>"\t", :headers=>true, :return_headers => true, :header_converters => :symbol, :converters => :all}) do |row|
	film = Hash[row.headers[0..-1].zip(row.fields[0..-1])]
	films[film[:id]] = film[:name]
	# puts film[:name]
	# puts n
	# n+=1
end

File.open('actors-array', 'w') {|f| f.write(actors) }
File.open('films-hash', 'w') {|f| f.write(films) }

actors.each{|actor| actor[:films]=actor[:films].map{|v| films[v]}}
File.open('final-actors', 'w') {|f| f.write(actors) }

# @conn = Mongo::Connection.new('localhost', 27017, :safe => true)
# @db   = @conn['sample-db']
# @coll = @db['test']

# @coll.remove
# 3.times do |i|
#   @coll.insert({'a' => i+1})
# end

# puts "There are #{@coll.count} records. Here they are:"
# @coll.find.each { |doc| puts doc.inspect }